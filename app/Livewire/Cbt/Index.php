<?php

namespace App\Livewire\Cbt;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $lamarans;

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
        return view('livewire.cbt.index');
    }
}

