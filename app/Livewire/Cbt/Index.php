<?php

namespace App\Livewire\Cbt;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $lamarans;
    public $search = '';

    public function mount()
    {
        $user = Auth::user();
        $kandidat = $user->kandidat ?? null;

        $this->lamarans = collect();

        if ($kandidat) {
            $this->lamarans = $kandidat->lamarLowongans()
                ->whereHas('progressRekrutmen', function ($q) {
                    $q->where('status', 'psikotes')
                      ->where('is_psikotes', true);
                })
                ->with('lowongan')
                ->get();
        }
    }

    public function render()
    {
        $filteredLamarans = $this->lamarans->filter(function ($lamaran) {
            $query = strtolower($this->search);

            if ($query === '') {
                return true;
            }

            return str_contains(strtolower($lamaran->lowongan->nama_posisi), $query)
                || str_contains(strtolower($lamaran->lowongan->departemen), $query)
                || str_contains(strtolower($lamaran->lowongan->lokasi_penugasan), $query);
        });

        return view('livewire.cbt.index', [
            'filteredLamarans' => $filteredLamarans,
        ]);
    }
}

