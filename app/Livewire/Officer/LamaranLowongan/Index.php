<?php

namespace App\Livewire\Officer\LamaranLowongan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\LamarLowongan;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    protected $listeners = ['refreshLamaran' => '$refresh'];

    public function render()
    {
        $lamaran = LamarLowongan::with(['kandidat.user', 'lowongan', 'progressRekrutmen'])
            ->when($this->search, function ($q) {
                $q->whereHas('lowongan', function ($qq) {
                    $qq->where('nama_posisi', 'like', '%' . $this->search . '%');
                })->orWhereHas('kandidat.user', function ($qq) {
                    $qq->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.officer.lamaran-lowongan.index', [
            'lamaranList' => $lamaran
        ]);
    }

    // Backward compatible dengan tombol lama
    public function accept($id)
    {
        $this->setStatus($id, 'diterima');
    }

    public function setStatus($id, $status)
    {
        $allowed = ['diterima', 'interview', 'psikotes', 'ditolak'];
        if (!in_array($status, $allowed, true)) {
            session()->flash('error', 'Status tidak valid.');
            return;
        }

        $lamaran = LamarLowongan::findOrFail($id);
    
        try {
            // Tambahkan progress baru
            $lamaran->progressRekrutmen()->create([
                'status' => $status,
                'officer_id' => auth()->id(), // Tambahkan ID officer yang mengubah status
                'nama_progress' => ucfirst($status), // Tambahkan nama progress
                'is_interview' => $status === 'interview',
                'is_psikotes' => $status === 'psikotes',
                'user_create' => auth()->user()->name
            ]);
    
            // Refresh tabel dan beri notifikasi
            $this->dispatch('refreshLamaran');
            session()->flash('success', "Status lamaran diubah ke: {$status}.");
        } catch (\Throwable $e) {
            Log::error('Gagal ubah status lamaran: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat menyimpan status.');
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public $linkZoom = []; // array keyed by lamaran_id

    public $editingZoom = [];

    public function startEditZoom($lamaranId)
    {
        // Temukan progress interview terakhir untuk mendapatkan link saat ini
        $latestInterview = \App\Models\ProgressRekrutmen::where('lamar_lowongan_id', $lamaranId)
            ->where('is_interview', true)
            ->latest('created_at')
            ->first();
            
        // Atur state untuk menampilkan form edit di view
        $this->editingZoom[$lamaranId] = true;
        // Isi form dengan data yang sudah ada
        $this->linkZoom[$lamaranId] = $latestInterview->link_zoom ?? '';
    }

    public function cancelEditZoom($lamaranId)
    {
        // Hapus state edit untuk menyembunyikan form
        unset($this->editingZoom[$lamaranId]);
        unset($this->linkZoom[$lamaranId]);
    }

    public function updateLinkZoom($lamaranId)
    {
        $this->validate([
            'linkZoom.'.$lamaranId => 'required|url',
        ], [
            'linkZoom.'.$lamaranId.'.required' => 'Link Zoom wajib diisi.',
            'linkZoom.'.$lamaranId.'.url'      => 'Format Link Zoom tidak valid.',
        ]);

        $latestInterview = \App\Models\ProgressRekrutmen::where('lamar_lowongan_id', $lamaranId)
            ->where('is_interview', true)
            ->latest('created_at')
            ->first();

        if ($latestInterview) {
            $latestInterview->update([
                'link_zoom' => $this->linkZoom[$lamaranId]
            ]);
            session()->flash('success', 'Link Zoom berhasil diperbarui.');
        } else {
            session()->flash('error', 'Gagal menemukan data interview.');
        }

        // Tutup mode edit setelah berhasil menyimpan
        $this->cancelEditZoom($lamaranId);
        $this->dispatch('refreshLamaran');
    }

    public function setLinkZoom($lamaranId)
    {
        $this->validate([
            'linkZoom.'.$lamaranId => 'required|url',
        ], [
            'linkZoom.'.$lamaranId.'.required' => 'Link Zoom wajib diisi.',
            'linkZoom.'.$lamaranId.'.url' => 'Format Link Zoom tidak valid.',
        ]);

        $lamaran = \App\Models\LamarLowongan::with('progressRekrutmen')->findOrFail($lamaranId);
        $latest = $lamaran->progressRekrutmen()->latest()->first();

        if (!$latest || $latest->status !== 'interview') {
            session()->flash('error', 'Tahap terakhir bukan Interview.');
            return;
        }

        $latest->update([
            'link_zoom' => $this->linkZoom[$lamaranId],
            'is_interview' => true,
        ]);

        session()->flash('success', 'Link Zoom tersimpan.');
        $this->dispatch('refreshLamaran');
    }
}
