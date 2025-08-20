<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateSpecificInfo extends Component
{
    public $worked_before;
    public $previous_work_location;
    public $job_info_source;
    public $gender_identity;

    public function mount()
    {
        $kandidat = Auth::user()->kandidat;
        $this->worked_before = $kandidat->worked_before;
        $this->previous_work_location = $kandidat->previous_work_location;
        $this->job_info_source = $kandidat->job_info_source;
        $this->gender_identity = $kandidat->gender_identity;
    }

    public function save()
    {
        $data = $this->validate([
            'worked_before' => 'required|boolean',
            'previous_work_location' => 'nullable|string',
            'job_info_source' => 'required|string',
            'gender_identity' => 'required|string',
        ]);

        Auth::user()->kandidat->update($data);
        session()->flash('status', 'Informasi spesifik tersimpan.');
    }

    public function render()
    {
        return view('livewire.profile.update-specific-info');
    }
}
