<?php

namespace App\Livewire\Kandidat\LowonganDilamar;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';

    public function render()
    {
        $user = Auth::user();
        $kandidat = $user->kandidat;

        // Handle the case where a user might not have a candidate profile yet
        if (!$kandidat) {
            // Return an empty paginator to prevent errors on a null object
            return view('livewire.kandidat.lowongan-dilamar.index', [
                'lamaranList' => new LengthAwarePaginator(new Collection(), 0, 10)
            ]);
        }

        // ## PERBAIKAN UTAMA: Query dimulai dari relasi, bukan dari model Lowongan ##
        // Ini akan secara otomatis mengambil lowongan yang hanya terkait dengan kandidat ini
        // melalui tabel pivot 'lamarlowongan'.
        $query = $kandidat->lowongans()->with('kategoriLowongan');

        // Terapkan filter pencarian pada nama posisi
        if (!empty($this->search)) {
            $query->where('nama_posisi', 'like', '%' . $this->search . '%');
        }

        // Terapkan filter status pada kolom di tabel pivot
        if (!empty($this->status)) {
            $query->wherePivot('status', $this->status);
        }

        // Ambil hasil dengan paginasi, diurutkan berdasarkan tanggal melamar
        $lamaranList = $query->latest('pivot_created_at')->paginate(10);
            
        return view('livewire.kandidat.lowongan-dilamar.index', [
            'lamaranList' => $lamaranList
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }
}