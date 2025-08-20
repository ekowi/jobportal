<?php

namespace App\Livewire\Profile;

use App\Models\Kandidat;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateWorkExperience extends Component
{
    public $experiences = [];

    public function mount()
    {
        $kandidat = Auth::user()->kandidat;
        $this->experiences = $kandidat->work_experiences ?? [
            ['start' => '', 'end' => '', 'company' => '', 'business' => '', 'position' => '', 'reason' => ''],
        ];
    }

    public function addExperience()
    {
        $this->experiences[] = ['start' => '', 'end' => '', 'company' => '', 'business' => '', 'position' => '', 'reason' => ''];
    }

    public function removeExperience($index)
    {
        unset($this->experiences[$index]);
        $this->experiences = array_values($this->experiences);
    }

    public function save()
    {
        $this->validate([
            'experiences.*.start' => 'required|date',
            'experiences.*.end' => 'nullable|date',
            'experiences.*.company' => 'required|string',
            'experiences.*.business' => 'nullable|string',
            'experiences.*.position' => 'required|string',
            'experiences.*.reason' => 'nullable|string',
        ]);

        $kandidat = Auth::user()->kandidat;
        $kandidat->update(['work_experiences' => $this->experiences]);
        session()->flash('status', 'Riwayat pengalaman kerja tersimpan.');
    }

    public function render()
    {
        return view('livewire.profile.update-work-experience');
    }
}
