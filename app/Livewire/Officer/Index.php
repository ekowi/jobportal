<?php
// TODO: FILTER SEARCH TIDAK BERFUNGSI
namespace App\Livewire\Officer;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Officer;
use App\Repositories\Interfaces\OfficerRepositoryInterface;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $officerRepository;

    public $notificationStatus = null;
    public $notificationMessage = '';

    // Search and filter properties
    public $search = '';
    public $jabatanFilter = '';
    public $lokasiFilter = '';

    // Pagination and sorting
    public $perPage = 10;
    public $sortField = 'nama_depan';
    public $sortDirection = 'asc';

    // Listen for the officer created event form modal
    protected $listeners = [
        'officerCreated' => '$refresh',
        'showNotification' => 'handleNotification'
    ];

    public function boot(OfficerRepositoryInterface $officerRepository)
    {
        $this->officerRepository = $officerRepository;
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingJabatanFilter()
    {
        $this->resetPage();
    }

    public function updatingLokasiFilter()
    {
        $this->resetPage();
    }


    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    // Reset all filters
    public function resetFilters()
    {
        $this->search = '';
        $this->jabatanFilter = '';
        $this->lokasiFilter = '';
        $this->resetPage();
    }

    public function applyFilters()
    {
        // This will cause the component to re-render with the new filter values
        $this->resetPage(); // Reset pagination when applying new filters
    }

    public function openCreateModal()
    {
        $this->dispatch('showModal');
    }

    public function openEditModal($officerId)
    {
        $this->dispatch('editOfficer', $officerId);
    }

    public function openDeleteModal($officerId)
    {
        $this->dispatch('deleteOfficer', $officerId);
    }

    public function handleNotification($data)
    {
        $this->notificationStatus = $data['status'];
        $this->notificationMessage = $data['message'];

    }

    public function render()
    {
        $filters = [
            'search' => $this->search,
            'jabatan' => $this->jabatanFilter,
            'lokasi' => $this->lokasiFilter
        ];

        $officers = $this->officerRepository->getAllOfficers(
            $filters,
            $this->sortField,
            $this->sortDirection,
            $this->perPage
        );

        // Get unique values for filter dropdowns
        $positions = $this->officerRepository->getUniquePositions();
        $locations = $this->officerRepository->getUniqueLocations();

        return view('livewire.officer.index', [
            'officers' => $officers,
            'positions' => $positions,
            'locations' => $locations
        ]);
    }
}
