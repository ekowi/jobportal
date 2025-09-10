<?php

namespace App\Repositories;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\KandidatRepositoryInterface;

class KandidatRepository extends Component
{
    public $nama_depan;
    public $nama_belakang;
    public $no_telpon;
    public $alamat;
    public $kode_pos;
    public $negara;
    public $no_ktp;
    public $no_npwp;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $status_perkawinan;
    public $agama;
    public $no_telpon_alternatif;
    public $pengalaman_kerja;
    public $pendidikan;
    public $kemampuan_bahasa;
    public $kemampuan;

    protected $kandidatRepository;

    // Hapus constructor
    // public function __construct(KandidatRepositoryInterface $kandidatRepository)
    // {
    //     $this->kandidatRepository = $kandidatRepository;
    // }

    public function mount(KandidatRepositoryInterface $kandidatRepository)
    {
        $this->kandidatRepository = $kandidatRepository;

        $user = Auth::user();
        $kandidat = $this->kandidatRepository->findByUserId($user->id);

        if ($kandidat) {
            $this->nama_depan = $kandidat->nama_depan;
            $this->nama_belakang = $kandidat->nama_belakang;
            $this->no_telpon = $kandidat->no_telpon;
            $this->alamat = $kandidat->alamat;
            $this->kode_pos = $kandidat->kode_pos;
            $this->negara = $kandidat->negara;
            $this->no_ktp = $kandidat->no_ktp;
            $this->no_npwp = $kandidat->no_npwp;
            $this->tempat_lahir = $kandidat->tempat_lahir;
            $this->tanggal_lahir = $kandidat->tanggal_lahir;
            $this->jenis_kelamin = $kandidat->jenis_kelamin;
            $this->status_perkawinan = $kandidat->status_perkawinan;
            $this->agama = $kandidat->agama;
            $this->no_telpon_alternatif = $kandidat->no_telpon_alternatif;
            $this->pengalaman_kerja = $kandidat->pengalaman_kerja;
            $this->pendidikan = $kandidat->pendidikan;
            $this->kemampuan_bahasa = $kandidat->kemampuan_bahasa;
            $this->kemampuan = $kandidat->kemampuan;
        }
    }

    public function save()
    {
        $this->validate([
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'nullable|string|max:255',
            'no_telpon' => 'required|string|max:15',
            'alamat' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|max:10',
            'negara' => 'nullable|string|max:255',
            'no_ktp' => 'nullable|string|max:20',
            'no_npwp' => 'nullable|string|max:20',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|string|max:10',
            'status_perkawinan' => 'nullable|string|max:255',
            'agama' => 'nullable|string|max:255',
            'no_telpon_alternatif' => 'nullable|string|max:15',
            'pengalaman_kerja' => 'nullable|string|max:1000',
            'pendidikan' => 'nullable|string|max:1000',
            'kemampuan_bahasa' => 'nullable|string|max:1000',
            'kemampuan' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $this->kandidatRepository->updateOrCreate(
            ['user_id' => $user->id],
            [
                'nama_depan' => $this->nama_depan,
                'nama_belakang' => $this->nama_belakang,
                'no_telpon' => $this->no_telpon,
                'alamat' => $this->alamat,
                'kode_pos' => $this->kode_pos,
                'negara' => $this->negara,
                'no_ktp' => $this->no_ktp,
                'no_npwp' => $this->no_npwp,
                'tempat_lahir' => $this->tempat_lahir,
                'tanggal_lahir' => $this->tanggal_lahir,
                'jenis_kelamin' => $this->jenis_kelamin,
                'status_perkawinan' => $this->status_perkawinan,
                'agama' => $this->agama,
                'no_telpon_alternatif' => $this->no_telpon_alternatif,
                'pengalaman_kerja' => $this->pengalaman_kerja,
                'pendidikan' => $this->pendidikan,
                'kemampuan_bahasa' => $this->kemampuan_bahasa,
                'kemampuan' => $this->kemampuan,
            ]
        );

        session()->flash('success', 'Your details have been updated successfully.');
    }

    public function render()
    {
        return view('livewire.kandidat.complete-apply');
    }
}
