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
        $fields = [
            'ktp',
            'ijazah',
            'sertifikat',
            'surat_pengalaman',
            'skck',
            'surat_sehat',
        ];

        foreach ($fields as $field) {
            if ($this->$field) {
                $column = $field . '_path';

                // Hapus file lama jika ada
                if ($this->kandidat->$column) {
                    Storage::disk('public')->delete($this->kandidat->$column);
                }

                // Simpan file baru dan update path di database
                $path = $this->$field->storeAs(
                    $basePath,
                    $field . '.' . $this->$field->getClientOriginalExtension(),
                    'public'
                );

                $this->kandidat->$column = $path;
            }
        }

        $this->kandidat->save();

        $this->refreshDocuments();
        $this->closeDocumentModal();
    }

    public function refreshDocuments()
    {
        $this->kandidat->refresh();
        $fields = [
            'ktp',
            'ijazah',
            'sertifikat',
            'surat_pengalaman',
            'skck',
            'surat_sehat',
        ];

        $files = [];
        foreach ($fields as $field) {
            $column = $field . '_path';
            if ($this->kandidat->$column) {
                $files[$field] = $this->kandidat->$column;
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
