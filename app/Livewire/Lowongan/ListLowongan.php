<?php

namespace App\Livewire\Lowongan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Interfaces\LowonganRepositoryInterface;
use App\Repositories\Interfaces\KategoriLowonganRepositoryInterface;

class ListLowongan extends Component
{
    use WithPagination;

    // Filter properties
    public $search = '';
    public $selectedCategory = '';
    public $selectedLocation = '';
    public $isRemote = '';
    public $salaryRange = '';

    protected $lowonganRepository;
    protected $kategoriRepository;

    // Inject repositories using Livewire's boot method
    public function boot(
        LowonganRepositoryInterface $lowonganRepository,
        KategoriLowonganRepositoryInterface $kategoriRepository
    ) {
        $this->lowonganRepository = $lowonganRepository;
        $this->kategoriRepository = $kategoriRepository;
    }

    public function mount()
    {
        $selectedCategory = request()->query('selectedCategory');
        if ($selectedCategory) {
            $this->selectedCategory = $selectedCategory;
        }
    }

    // Filter method
    public function applyFilter()
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->search = '';
        $this->selectedCategory = '';
        $this->selectedLocation = '';
        $this->isRemote = '';
        $this->salaryRange = '';
        $this->resetPage();
    }

    public function render()
    {
        // Hapus dd() ini agar proses rendering bisa lanjut
        // dd("Rendering ListLowongan with filters: ", [
        //     'search' => $this->search,
        //     'selectedCategory' => $this->selectedCategory,
        //     'selectedLocation' => $this->selectedLocation,
        //     'isRemote' => $this->isRemote,
        //     'salaryRange' => $this->salaryRange,
        // ]);

        // Use repository to get filtered data instead of direct model query
        $lowongans = $this->lowonganRepository->getAllWithFilters(
            $this->search,
            $this->selectedCategory,
            $this->selectedLocation,
            $this->isRemote,
            $this->salaryRange
        );

        // Use repository to get locations
        $locations = $this->lowonganRepository->getDistinctLocations();

        // Use repository to get categories
        $categories = $this->kategoriRepository->getActive();

        // Use repository to get salary ranges
        $salaryRanges = $this->lowonganRepository->getSalaryRanges();

        return view('livewire.lowongan.list-lowongan', compact('lowongans', 'locations', 'categories', 'salaryRanges'));
    }
}
