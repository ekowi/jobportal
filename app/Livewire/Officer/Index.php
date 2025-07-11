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

    // Search and filter properties
    public $search = '';
    public $jabatanFilter = '';
    public $lokasiFilter = '';

    // Pagination and sorting
    public $perPage = 10;
    public $sortField = 'nama_depan';
    public $sortDirection = 'asc';


    // Modal State
    public $showCreateModal = false;
    public $officerData = [];
    public $userData = [];
    public $selectedLocation = '';
    public $newLocationName = '';
    public $supervisors = [];

    // Validation rules
    protected function rules()
    {
        return [
            'officerData.nama_depan' => 'required|min:2',
            'officerData.nama_belakang' => 'nullable|min:1',
            'officerData.nik' => 'required|unique:officers,nik',
            'officerData.jabatan' => 'required',
            'officerData.doh' => 'required|date',
            'officerData.area' => 'required|in:1,2,3',
            'officerData.atasan_id' => 'nullable|exists:officers,user_id',
            'selectedLocation' => 'required_unless:newLocationName,null', // Location must be selected unless a new one is being added
        'newLocationName' => 'required_if:selectedLocation,custom|min:3', // New location name required if custom is selected
            'userData.email' => 'required|email|unique:users,email',
            'userData.password' => 'required|min:8',
        ];
    }

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
        $this->showCreateModal = true;
        $this->resetInputFields();
        $this->supervisors = $this->officerRepository->getAllOfficersForSupervisorSelection();
    }

    public function closeModal()
    {
        $this->showCreateModal = false;
        $this->resetInputFields();
        $this->resetValidation();
    }

    public function resetInputFields()
    {
        $this->officerData = [];
        $this->userData = [];
        $this->selectedLocation = '';
        $this->newLocationName = '';
    }

    public function createOfficer()
    {
        $this->validate();

        if ($this->selectedLocation === 'custom' && !empty($this->newLocationName)) {
            $this->officerData['lokasi_penugasan'] = $this->newLocationName;
        } elseif ($this->selectedLocation !== 'custom') {
            $this->officerData['lokasi_penugasan'] = $this->selectedLocation;
        } else {
            session()->flash('error', __('Please select a valid location.'));
            return;
        }

        try {
            $this->officerRepository->createOfficerWithUser($this->officerData, $this->userData);

            $this->closeModal();
            session()->flash('success', __('Officer created successfully.'));
        } catch (\Exception $e) {
            session()->flash('error', __('Failed to create officer: ') . $e->getMessage());
        }
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
