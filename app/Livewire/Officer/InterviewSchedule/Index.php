<?php

namespace App\Livewire\Officer\InterviewSchedule;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\ProgressRekrutmen;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $resultModal = false;
    public $resultProgressId;
    public $resultCatatan;
    public $resultDokumen;

    protected $listeners = ['refreshSchedule' => '$refresh'];

    public function render()
    {
        $interviews = ProgressRekrutmen::with(['lamarlowongan.kandidat.user'])
            ->where('status', 'interview')
            ->where('officer_id', auth()->id())
            ->where('is_interview', true)
            ->orderBy('waktu_pelaksanaan')
            ->paginate(10);

        return view('livewire.officer.interview-schedule.index', [
            'interviews' => $interviews,
        ]);
    }

    public function openResultModal($progressId)
    {
        $this->resultProgressId = $progressId;
        $this->resultCatatan = '';
        $this->resultDokumen = null;
        $this->resultModal = true;
    }

    public function saveResult()
    {
        $this->validate([
            'resultCatatan' => 'nullable|string',
            'resultDokumen' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx',
        ]);

        $progress = ProgressRekrutmen::findOrFail($this->resultProgressId);

        $data = ['catatan' => $this->resultCatatan];
        if ($this->resultDokumen) {
            $data['dokumen_pendukung'] = $this->resultDokumen->store('dokumen-pendukung', 'public');
        }

        try {
            $progress->update($data);
            $this->resultModal = false;
            session()->flash('success', 'Hasil interview tersimpan.');
            $this->dispatch('refreshSchedule');
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan hasil interview: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }
}
