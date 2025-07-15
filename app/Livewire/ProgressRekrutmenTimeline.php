<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Interfaces\ProgressRekrutmenRepositoryInterface;

class ProgressRekrutmenTimeline extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';
    public $filterLowongan = '';
    public $selectedProgress = null;
    public $showDetail = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'filterStatus' => ['except' => ''],
        'filterLowongan' => ['except' => ''],
    ];

    protected $progressRekrutmenRepository;

    public function boot(ProgressRekrutmenRepositoryInterface $progressRekrutmenRepository)
    {
        $this->progressRekrutmenRepository = $progressRekrutmenRepository;
    }

    public function mount()
    {
        // Initialize component
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function updatingFilterLowongan()
    {
        $this->resetPage();
    }

    public function showProgressDetail($progressId)
    {
        $this->selectedProgress = $this->progressRekrutmenRepository->getDetailProgressById($progressId);
        $this->showDetail = true;
    }

    public function closeDetail()
    {
        $this->showDetail = false;
        $this->selectedProgress = null;
    }

    public function getStatusColor($status)
    {
        return $this->progressRekrutmenRepository->getStatusColor($status);
    }

    public function render()
    {
        $lamarLowongans = $this->progressRekrutmenRepository->getUniqueLamarLowongans(
            $this->search,
            $this->filterLowongan,
            10
        );

        $lowongans = $this->progressRekrutmenRepository->getLowonganOptions();

        return view('livewire.progress-rekrutmen-timeline', [
            'lamarLowongans' => $lamarLowongans,
            'lowongans' => $lowongans,
        ]);
    }
}
