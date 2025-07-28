<?php

namespace App\Livewire\KategoriSoal;

use Livewire\Component;
use App\Models\KategoriSoal;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $kategoriId;
    public $nama_kategori;
    public $deskripsi;
    public $status = true;

    protected $rules = [
        'nama_kategori' => 'required|min:3',
        'deskripsi' => 'nullable'
    ];

    public function render()
    {
        return view('livewire.kategorisoal.index', [
            'kategoris' => KategoriSoal::where('nama_kategori', 'like', '%'.$this->search.'%')
                ->latest()
                ->paginate(10)
        ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $kategori = KategoriSoal::findOrFail($id);
        $this->kategoriId = $id;
        $this->nama_kategori = $kategori->nama_kategori;
        $this->deskripsi = $kategori->deskripsi;
        $this->status = $kategori->status;
        
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nama_kategori' => $this->nama_kategori,
            'deskripsi' => $this->deskripsi,
            'status' => $this->status
        ];

        if ($this->kategoriId) {
            KategoriSoal::find($this->kategoriId)->update($data);
            session()->flash('message', 'Kategori berhasil diperbarui.');
        } else {
            KategoriSoal::create($data);
            session()->flash('message', 'Kategori berhasil ditambahkan.');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete($id)
    {
        KategoriSoal::find($id)->delete();
        session()->flash('message', 'Kategori berhasil dihapus.');
    }

    private function resetForm()
    {
        $this->kategoriId = null;
        $this->nama_kategori = '';
        $this->deskripsi = '';
        $this->status = true;
    }
}