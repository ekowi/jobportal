<?php

namespace App\Livewire\Officer;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Officer;

class Index extends Component
{
    use WithPagination;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $sortField = 'nama_lengkap';
    public $sortDirection = 'asc';

    public function updatingSearch()
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

    public function render()
    {
        $officers = Officer::query()
            ->when($this->search, function($query) {
                return $query->where('nama_lengkap', 'like', '%' . $this->search . '%')
                    ->orWhere('nik', 'like', '%' . $this->search . '%')
                    ->orWhere('jabatan', 'like', '%' . $this->search . '%')
                    ->orWhere('lokasi_penugasan', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.officer.index', [
            'officers' => $officers
        ]);
    }
}
