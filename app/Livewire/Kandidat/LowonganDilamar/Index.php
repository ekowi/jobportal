<?php

namespace App\Livewire\Kandidat\LowonganDilamar;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $user = Auth::user();

        // Pastikan relasi kandidat->lamarLowongans ada
        $query = $user->kandidat
            ->lamarLowongans()
            ->with(['lowongan', 'progressRekrutmen.officer'])
            ->when($this->search, function ($q) {
                $q->whereHas('lowongan', function ($qq) {
                    $qq->where('nama_posisi', 'like', '%' . $this->search . '%');
                });
            })
            ->latest();

        $lamaranList = $query->paginate(10);

        return view('livewire.kandidat.lowongan-dilamar.index', [
            'lamaranList' => $lamaranList
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
