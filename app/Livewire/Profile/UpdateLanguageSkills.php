<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateLanguageSkills extends Component
{
    public $languages = [];

    public function mount()
    {
        $kandidat = Auth::user()->kandidat;
        $this->languages = $kandidat->language_skills ?? [
            ['language' => '', 'speaking' => '', 'reading' => '', 'writing' => ''],
        ];
    }

    public function addLanguage()
    {
        $this->languages[] = ['language' => '', 'speaking' => '', 'reading' => '', 'writing' => ''];
    }

    public function removeLanguage($index)
    {
        unset($this->languages[$index]);
        $this->languages = array_values($this->languages);
    }

    public function save()
    {
        $this->validate([
            'languages.*.language' => 'required|string',
            'languages.*.speaking' => 'required|string',
            'languages.*.reading' => 'required|string',
            'languages.*.writing' => 'required|string',
        ]);

        $kandidat = Auth::user()->kandidat;
        $kandidat->update(['language_skills' => $this->languages]);
        session()->flash('status', 'Keterampilan bahasa tersimpan.');
    }

    public function render()
    {
        return view('livewire.profile.update-language-skills');
    }
}
