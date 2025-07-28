<?php

namespace App\Livewire\BankSoal;

use Livewire\Component;
use App\Models\Soal;
use App\Models\KategoriSoal;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $soalId;
    public $id_kategori_soal;
    public $soal;
    public $pilihan_1;
    public $pilihan_2;
    public $pilihan_3;
    public $pilihan_4;
    public $jawaban;
    public $status = true;

    protected $rules = [
        'id_kategori_soal' => 'required',
        'soal' => 'required',
        'pilihan_1' => 'required',
        'pilihan_2' => 'required',
        'pilihan_3' => 'required',
        'pilihan_4' => 'required',
        'jawaban' => 'required|in:1,2,3,4',
    ];

    public function render()
    {
        return view('livewire.bank-soal.index', [
            'soals' => Soal::with('kategori')
                ->when($this->search, fn($query) => 
                    $query->where('soal', 'like', '%' . $this->search . '%')
                )
                ->latest()
                ->paginate(10),
            'kategoriSoals' => KategoriSoal::where('status', true)->get()
        ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $soal = Soal::findOrFail($id);
        $this->soalId = $id;
        $this->id_kategori_soal = $soal->id_kategori_soal;
        $this->soal = $soal->soal;
        $this->pilihan_1 = $soal->pilihan_1;
        $this->pilihan_2 = $soal->pilihan_2;
        $this->pilihan_3 = $soal->pilihan_3;
        $this->pilihan_4 = $soal->pilihan_4;
        $this->jawaban = $soal->jawaban;
        $this->status = $soal->status;
        
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'id_kategori_soal' => $this->id_kategori_soal,
            'soal' => $this->soal,
            'pilihan_1' => $this->pilihan_1,
            'pilihan_2' => $this->pilihan_2,
            'pilihan_3' => $this->pilihan_3,
            'pilihan_4' => $this->pilihan_4,
            'jawaban' => $this->jawaban,
            'status' => $this->status
        ];

        if ($this->soalId) {
            Soal::find($this->soalId)->update($data);
            session()->flash('message', 'Soal berhasil diperbarui.');
        } else {
            Soal::create($data);
            session()->flash('message', 'Soal berhasil ditambahkan.');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete($id)
    {
        Soal::find($id)->delete();
        session()->flash('message', 'Soal berhasil dihapus.');
    }

    private function resetForm()
    {
        $this->soalId = null;
        $this->id_kategori_soal = '';
        $this->soal = '';
        $this->pilihan_1 = '';
        $this->pilihan_2 = '';
        $this->pilihan_3 = '';
        $this->pilihan_4 = '';
        $this->jawaban = '';
        $this->status = true;
    }

    public function getJawabanBenarText($soal)
    {
        return $soal->jawaban_benar_text;
    }
}
