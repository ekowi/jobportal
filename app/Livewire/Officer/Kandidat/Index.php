<?php

namespace App\Livewire\Officer\Kandidat;

use Livewire\Component;
use App\Models\Kandidat;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $showDetailModal = false;
    public $selectedKandidat = null;
    public $kandidatIdToDelete = null;
    public $showEditModal = false;
    public $editingKandidatId = null;
    public $editingKandidat = [
        'nama_depan' => '',
        'nama_belakang' => '',
        'no_telpon' => '',
    ];

    public function render()
    {
        $query = Kandidat::query()
            ->with('user')
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('nama_depan', 'like', '%' . $this->search . '%')
                      ->orWhere('nama_belakang', 'like', '%' . $this->search . '%')
                      ->orWhere('no_telpon', 'like', '%' . $this->search . '%')
                      ->orWhereHas('user', function($q) {
                          $q->where('email', 'like', '%' . $this->search . '%');
                      });
                });
            });

        return view('livewire.officer.kandidat.index', [
            'kandidats' => $query->paginate(10)
        ]);
    }

    public function showDetail($id)
    {
        $this->selectedKandidat = Kandidat::with('user')->find($id);
        $this->showDetailModal = true;
    }

    public function closeModal()
    {
        $this->showDetailModal = false;
        $this->selectedKandidat = null;
    }

    public function edit($id)
    {
        $kandidat = Kandidat::findOrFail($id);
        $this->editingKandidatId = $id;
        $this->editingKandidat = $kandidat->only(['nama_depan','nama_belakang','no_telpon']);
        $this->showEditModal = true;
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->editingKandidatId = null;
    }

    public function updateKandidat()
    {
        $this->validate([
            'editingKandidat.nama_depan' => ['required','string','max:255'],
            'editingKandidat.nama_belakang' => ['nullable','string','max:255'],
            'editingKandidat.no_telpon' => ['required','string','max:20'],
        ]);

        if ($this->editingKandidatId) {
            Kandidat::find($this->editingKandidatId)->update($this->editingKandidat);
            session()->flash('success', 'Data kandidat berhasil diperbarui.');
        }

        $this->closeEditModal();
    }

    public function confirmDelete($id)
    {
        $this->kandidatIdToDelete = $id;
        $this->dispatch('confirm-delete');
    }

    public function deleteKandidat()
    {
        if ($this->kandidatIdToDelete) {
            $kandidat = Kandidat::find($this->kandidatIdToDelete);
            if ($kandidat) {
                $kandidat->delete();
                session()->flash('success', 'Data kandidat berhasil dihapus.');
            }
            $this->kandidatIdToDelete = null;
        }
    }
}