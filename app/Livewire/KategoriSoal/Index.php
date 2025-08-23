<?php

namespace App\Livewire\KategoriSoal;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Interfaces\KategoriSoalRepositoryInterface;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $kategoriId;
    public $nama_kategori;
    public $deskripsi;
    public $status = true;
    
    // Repository akan di-inject secara otomatis oleh Laravel
    private KategoriSoalRepositoryInterface $kategoriRepo;

    protected $rules = [
        'nama_kategori' => 'required|min:3',
        'deskripsi' => 'nullable'
    ];
    
    // Gunakan constructor untuk dependency injection
    public function __construct()
    {
        // Resolve repository dari service container Laravel
        $this->kategoriRepo = resolve(KategoriSoalRepositoryInterface::class);
    }

    public function render()
    {
        return view('livewire.kategorisoal.index', [
            'kategoris' => $this->kategoriRepo->getPaginated($this->search, 10)
        ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $kategori = $this->kategoriRepo->find($id);
        $this->kategoriId = $id;
        $this->nama_kategori = $kategori->nama_kategori;
        $this->deskripsi = $kategori->deskripsi;
        $this->status = (bool) $kategori->status;
        
        $this->showModal = true;
    }

    public function save()
    {
        $data = $this->validate();
        $data['status'] = $this->status;

        if ($this->kategoriId) {
            $this->kategoriRepo->update($this->kategoriId, $data);
            session()->flash('message', 'Kategori berhasil diperbarui.');
        } else {
            $this->kategoriRepo->create($data);
            session()->flash('message', 'Kategori berhasil ditambahkan.');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete($id)
    {
        $this->kategoriRepo->delete($id);
        session()->flash('message', 'Kategori berhasil dihapus.');
    }

    private function resetForm()
    {
        $this->kategoriId = null;
        $this->nama_kategori = '';
        $this->deskripsi = '';
        $this->status = true;
        $this->resetErrorBag();
    }
}