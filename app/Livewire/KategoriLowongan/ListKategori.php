<?php
namespace App\Livewire\KategoriLowongan;

use Livewire\Component;
use App\Models\KategoriLowongan;
use App\Repositories\Interfaces\KategoriLowonganRepositoryInterface;
use App\Repositories\KategoriLowonganRepository;

class ListKategori extends Component
{
    protected $kategoriLowonganRepository;

    public function boot(KategoriLowonganRepositoryInterface $kategoriLowonganRepository)
    {
        $this->kategoriLowonganRepository = $kategoriLowonganRepository;
    }
    public function render()
    {
        $kategoris = $this->kategoriLowonganRepository->getActive();
        return view('livewire.kategori-lowongan.list-kategori', compact('kategoris'));
    }
}
