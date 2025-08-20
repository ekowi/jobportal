<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateEducationHistory extends Component
{
    public $educations = [];

    public function mount()
    {
        $kandidat = Auth::user()->kandidat;
        $this->educations = $kandidat->education_history ?? [
            ['start' => '', 'end' => '', 'name' => '', 'major' => '', 'level' => '', 'highest' => false],
        ];
    }

    public function addEducation()
    {
        $this->educations[] = ['start' => '', 'end' => '', 'name' => '', 'major' => '', 'level' => '', 'highest' => false];
    }

    public function removeEducation($index)
    {
        unset($this->educations[$index]);
        $this->educations = array_values($this->educations);
    }

    public function save()
    {
        $this->validate([
            'educations.*.start' => 'required|date',
            'educations.*.end' => 'required|date',
            'educations.*.name' => 'required|string',
            'educations.*.major' => 'nullable|string',
            'educations.*.level' => 'required|string',
            'educations.*.highest' => 'boolean',
        ]);

        $kandidat = Auth::user()->kandidat;
        $kandidat->update(['education_history' => $this->educations]);
        session()->flash('status', 'Riwayat pendidikan tersimpan.');
    }

    public function render()
    {
        return view('livewire.profile.update-education-history');
    }
}
