<?php

namespace App\Livewire\Officer\LamaranLowongan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\LamarLowongan;
use App\Models\User;
use App\Models\Kandidat;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    protected $listeners = ['refreshLamaran' => '$refresh'];

    public $officerList = [];

    public $interviewModal = false;
    public $interviewLamaranId;
    public $interviewLink;
    public $interviewWaktu;
    public $interviewOfficer;

    // Modal melihat profil kandidat
    public $showProfileModal = false;
    public $selectedKandidat;
    public $documents = [];


    public function mount()
    {
        $this->officerList = User::where('role', 'officer')->get();
    }

    public function render()
    {
        $lamaran = LamarLowongan::with(['kandidat.user', 'lowongan', 'progressRekrutmen.officer'])
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

    public function openProfile($kandidatId)
    {
        $this->selectedKandidat = Kandidat::with('user')->find($kandidatId);
        $this->loadDocuments();
        $this->showProfileModal = true;
    }

    protected function loadDocuments()
    {
        $this->documents = [];
        if ($this->selectedKandidat) {
            $path = 'documents/' . $this->selectedKandidat->user_id;
            if (Storage::disk('public')->exists($path)) {
                foreach (Storage::disk('public')->files($path) as $file) {
                    $name = pathinfo($file, PATHINFO_FILENAME);
                    $this->documents[$name] = Storage::url($file);
                }
            }
        }
    }

    public function closeProfile()
    {
        $this->showProfileModal = false;
        $this->selectedKandidat = null;
        $this->documents = [];
    }

    // Backward compatible dengan tombol lama
    public function accept($id)
    {
        $this->setStatus($id, 'diterima');
    }

    public function setStatus($id, $status)
    {
        $allowed = ['diterima', 'psikotes', 'ditolak'];
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
                'is_interview' => false,
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

    public function prepareInterview($lamaranId)
    {
        $this->interviewLamaranId = $lamaranId;
        $this->interviewLink = '';
        $this->interviewWaktu = '';
        $this->interviewOfficer = '';
        $this->interviewModal = true;
    }

    public function saveInterview()
    {
        $this->validate([
            'interviewLink' => 'required|url',
            'interviewWaktu' => 'required|date',
            'interviewOfficer' => 'required|exists:users,id',
        ], [
            'interviewLink.required' => 'Link Zoom wajib diisi.',
            'interviewLink.url' => 'Format Link Zoom tidak valid.',
            'interviewWaktu.required' => 'Waktu pelaksanaan wajib diisi.',
            'interviewOfficer.required' => 'Interviewer wajib dipilih.',
        ]);

        $lamaran = LamarLowongan::findOrFail($this->interviewLamaranId);
        try {
            $lamaran->progressRekrutmen()->create([
                'status' => 'interview',
                'officer_id' => $this->interviewOfficer,
                'nama_progress' => 'Interview',
                'is_interview' => true,
                'waktu_pelaksanaan' => $this->interviewWaktu,
                'link_zoom' => $this->interviewLink,
                'user_create' => auth()->user()->name,
            ]);
            session()->flash('success', 'Interview dijadwalkan.');
            $this->interviewModal = false;
            $this->dispatch('refreshLamaran');
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan interview: '.$e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

}
