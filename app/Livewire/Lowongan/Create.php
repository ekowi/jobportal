<?php
namespace App\Livewire\Lowongan;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\LowonganRepositoryInterface;
use App\Repositories\Interfaces\KategoriLowonganRepositoryInterface;

class Create extends Component
{
    use WithFileUploads;

    public $kategori_lowongan_id;
    public $nama_posisi;
    public $departemen;
    public $lokasi_penugasan;
    public $is_remote = false;
    public $tanggal_posting;
    public $tanggal_berakhir;
    public $foto;
    public $deskripsi;
    public $range_gaji;
    public $kemampuan_yang_dibutuhkan;

    public $status = 'posted'; // draft|scheduled

    public $notificationStatus;
    public $notificationMessage;
    public $kategoriLowonganOptions = [];

    protected $lowonganRepo;
    protected $kategoriRepo;

    public function boot(
        LowonganRepositoryInterface $lowonganRepo,
        KategoriLowonganRepositoryInterface $kategoriRepo
    ) {
        $this->lowonganRepo = $lowonganRepo;
        $this->kategoriRepo = $kategoriRepo;
    }

    public function mount()
    {
        $this->kategoriLowonganOptions = $this->kategoriRepo->getActive();
    }

    public function rules()
    {
        return [
            'kategori_lowongan_id' => 'required|integer',
            'nama_posisi' => 'required|string',
            'departemen' => 'required|string',
            'lokasi_penugasan' => 'required|string',
            'is_remote' => 'boolean',
            'tanggal_posting' => 'required|date',
            'tanggal_berakhir' => 'nullable|date|after_or_equal:tanggal_posting',
            'foto' => 'nullable|image|max:2048',
            'deskripsi' => 'required|string',
            'range_gaji' => 'nullable|string',
            'kemampuan_yang_dibutuhkan' => 'nullable|string',
        ];
    }

    public function save()
    {
        $this->validate();

        $fotoFilename = null;
        if ($this->foto) {
            $fotoFilename = $this->foto->store('image/lowongan', 'public');
            $fotoFilename = basename($fotoFilename);
        }

        $result = $this->lowonganRepo->createLowongan([
            'kategori_lowongan_id' => $this->kategori_lowongan_id,
            'nama_posisi' => $this->nama_posisi,
            'departemen' => $this->departemen,
            'lokasi_penugasan' => $this->lokasi_penugasan,
            'is_remote' => $this->is_remote,
            'tanggal_posting' => $this->tanggal_posting,
            'tanggal_berakhir' => $this->tanggal_berakhir,
            'foto' => $fotoFilename,
            'deskripsi' => $this->deskripsi,
            'range_gaji' => $this->range_gaji,
            'kemampuan_yang_dibutuhkan' => $this->kemampuan_yang_dibutuhkan,
            'is_active' => true,
            'status' => $this->status,
            'user_create' => Auth::id(),
        ]);

        if ($result) {
            $this->notificationStatus = 'success';
            $this->notificationMessage = 'Lowongan berhasil ditambahkan.';
        } else {
            $this->notificationStatus = 'error';
            $this->notificationMessage = 'Lowongan gagal ditambahkan.';
        }
        $this->dispatch('lowonganUpdated');
        return redirect()->route('lowongan.index');
    }

    public function render()
    {
        return view('livewire.lowongan.create');
    }
}
