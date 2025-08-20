<?php

namespace App\Livewire\Profile;

use App\Models\Kandidat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowProfile extends Component
{
    use WithFileUploads;

    public $kandidat;

    /**
     * Uploaded document placeholders
     */
    public $ktp;
    public $ijazah;
    public $sertifikat;
    public $surat_pengalaman;
    public $skck;
    public $surat_sehat;

    public $showDocumentModal = false;
    public $documents = [];

    public function mount()
    {
        // Mengambil data user yang sedang login beserta relasi 'kandidat'
        $user = Auth::user()->load('kandidat');
        $this->kandidat = $user->kandidat;

        $this->refreshDocuments();
    }

    public function openDocumentModal()
    {
        $this->resetUploadFields();
        $this->refreshDocuments();
        $this->showDocumentModal = true;
    }

    public function closeDocumentModal()
    {
        $this->showDocumentModal = false;
    }

    protected function resetUploadFields()
    {
        $this->ktp = $this->ijazah = $this->sertifikat = $this->surat_pengalaman = $this->skck = $this->surat_sehat = null;
    }

    public function uploadDocuments()
    {
        $userId = Auth::id();
        $basePath = "documents/{$userId}";

        if ($this->ktp) {
            $this->ktp->storeAs($basePath, 'ktp.' . $this->ktp->getClientOriginalExtension(), 'public');
        }
        if ($this->ijazah) {
            $this->ijazah->storeAs($basePath, 'ijazah.' . $this->ijazah->getClientOriginalExtension(), 'public');
        }
        if ($this->sertifikat) {
            $this->sertifikat->storeAs($basePath, 'sertifikat.' . $this->sertifikat->getClientOriginalExtension(), 'public');
        }
        if ($this->surat_pengalaman) {
            $this->surat_pengalaman->storeAs($basePath, 'surat_pengalaman.' . $this->surat_pengalaman->getClientOriginalExtension(), 'public');
        }
        if ($this->skck) {
            $this->skck->storeAs($basePath, 'skck.' . $this->skck->getClientOriginalExtension(), 'public');
        }
        if ($this->surat_sehat) {
            $this->surat_sehat->storeAs($basePath, 'surat_sehat.' . $this->surat_sehat->getClientOriginalExtension(), 'public');
        }

        $this->refreshDocuments();
        $this->closeDocumentModal();
    }

    public function refreshDocuments()
    {
        $userId = Auth::id();
        $path = "documents/{$userId}";
        $files = [];

        if (Storage::disk('public')->exists($path)) {
            foreach (Storage::disk('public')->files($path) as $file) {
                $name = pathinfo($file, PATHINFO_FILENAME);
                $files[$name] = Storage::url($file);
            }
        }

        $this->documents = $files;
    }

    public function render()
    {
        // Memberitahu Livewire untuk menggunakan layout utama 'layouts.app'
        return view('livewire.profile.show-profile');
    }
}
