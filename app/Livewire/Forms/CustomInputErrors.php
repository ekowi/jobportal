<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class CustomInputErrors extends Component
{
    public $for;

    public function mount($for)
    {
        $this->for = $for;
    }
    public function render()
    {
        return view('livewire.forms.custom-input-errors');
    }
}
