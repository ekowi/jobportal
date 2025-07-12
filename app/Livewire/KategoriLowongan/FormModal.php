<?php
namespace App\Livewire\KategoriLowongan;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Repositories\Interfaces\KategoriLowonganRepositoryInterface;

class FormModal extends Component
{
    use WithFileUploads;

    public $show = false;
    public $mode = 'create'; // create|edit|delete
    public $kategoriId;
    public $nama_kategori;
    public $deskripsi;

    public $logo;
    public $oldLogo;

    protected $kategoriRepo;

    protected $listeners = [
        'editKategoriLowongan' => 'openEditModal',
        'deleteKategoriLowongan' => 'openDeleteModal',
        'showCreateModal' => 'openCreateModal',
    ];

    public function boot(KategoriLowonganRepositoryInterface $kategoriRepo)
    {
        $this->kategoriRepo = $kategoriRepo;
    }

    public function openCreateModal()
    {
        $this->resetFields();
        $this->mode = 'create';
        $this->show = true;
    }

    public function openEditModal($id)
    {
        $this->resetFields();
        $kategori = $this->kategoriRepo->find($id);
        $this->kategoriId = $id;
        $this->nama_kategori = $kategori->nama_kategori;
        $this->deskripsi = $kategori->deskripsi;
        $this->oldLogo = $kategori->logo;
        $this->logo = null;
        $this->mode = 'edit';
        $this->show = true;
    }

    public function openDeleteModal($id)
    {
        $this->kategoriId = $id;
        $this->mode = 'delete';
        $this->show = true;
    }



    public function save()
    {
        $this->validate([
            'nama_kategori' => 'required|unique:kategori_lowongans,nama_kategori,' . $this->kategoriId,
            'deskripsi' => 'nullable|string',
            'logo' => $this->mode === 'create' ? 'nullable|image|max:1024' : 'nullable|image|max:1024',
        ]);

        $logoFilename = $this->oldLogo;

        if ($this->logo) {
            $logoFilename = $this->logo->store('image/logo/kategori-lowongan', 'public');
            $logoFilename = basename($logoFilename);
            // Jika edit, hapus logo lama
            if ($this->mode === 'edit' && $this->oldLogo && file_exists(public_path('image/logo/kategori-lowongan/' . $this->oldLogo))) {
                @unlink(public_path('image/logo/kategori-lowongan/' . $this->oldLogo));
            }
        }

        if ($this->mode === 'create') {
            $this->kategoriRepo->create([
                'nama_kategori' => $this->nama_kategori,
                'deskripsi' => $this->deskripsi,
                'logo' => $logoFilename,
                'is_active' => true,
                'user_create' => Auth::id(),
            ]);
        } elseif ($this->mode === 'edit') {
            $this->kategoriRepo->update($this->kategoriId, [
                'nama_kategori' => $this->nama_kategori,
                'deskripsi' => $this->deskripsi,
                'logo' => $logoFilename,
                'user_update' => Auth::id(),
            ]);
        }
        $this->show = false;
        $this->dispatch('kategoriLowonganUpdated');
    }

    public function softDelete()
    {
        $this->kategoriRepo->softDelete($this->kategoriId, Auth::id());
        $this->show = false;
        $this->dispatch('kategoriLowonganDeleted');
    }

    public function resetFields()
    {
        $this->kategoriId = null;
        $this->nama_kategori = '';
        $this->deskripsi = '';
        $this->logo = null;
        $this->oldLogo = null;
    }

    public function closeModal()
    {
        $this->show = false;
        $this->resetFields();
    }

    public function render()
    {
        return view('livewire.kategori-lowongan.form-modal');
    }
}
