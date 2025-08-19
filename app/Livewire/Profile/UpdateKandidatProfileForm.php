<?php

namespace App\Livewire\Profile;

use App\Models\Kandidat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UpdateKandidatProfileForm extends Component
{
    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * The kandidat model instance.
     *
     * @var \App\Models\Kandidat
     */
    public $kandidat;

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $user = Auth::user()->load('kandidat');
        $this->kandidat = $user->kandidat;

        if ($this->kandidat) {
            // Jika kandidat sudah ada, muat datanya
            $this->state = $this->kandidat->toArray();

            // Pastikan field baru tersedia
            $this->state['nama_tengah'] = $this->state['nama_tengah'] ?? '';
            $this->state['kota'] = $this->state['kota'] ?? '';
            $this->state['pernah_bekerja'] = $this->state['pernah_bekerja'] ?? '';
            $this->state['lokasi_bekerja'] = $this->state['lokasi_bekerja'] ?? '';
            $this->state['sumber_informasi'] = $this->state['sumber_informasi'] ?? '';

            // Decode JSON fields to arrays
            $this->state['pengalaman_kerja'] = $this->kandidat->pengalaman_kerja ? json_decode($this->kandidat->pengalaman_kerja, true) : [
                ['tanggal_mulai' => '', 'tanggal_selesai' => '', 'nama_perusahaan' => '', 'keterangan_bisnis' => '', 'jabatan' => '', 'alasan_keluar' => ''],
            ];
            $this->state['pendidikan'] = $this->kandidat->pendidikan ? json_decode($this->kandidat->pendidikan, true) : [
                ['tanggal_mulai' => '', 'tanggal_selesai' => '', 'nama_pendidikan' => '', 'jurusan' => '', 'tingkat' => '', 'pendidikan_tertinggi' => 'Tidak'],
            ];
            $this->state['kemampuan_bahasa'] = $this->kandidat->kemampuan_bahasa ? json_decode($this->kandidat->kemampuan_bahasa, true) : [
                ['bahasa' => '', 'bicara' => '', 'membaca' => '', 'menulis' => ''],
            ];

            // PERBAIKAN: Ubah format tanggal agar sesuai dengan input HTML
            if (isset($this->state['tanggal_lahir'])) {
                $this->state['tanggal_lahir'] = \Carbon\Carbon::parse($this->state['tanggal_lahir'])->setTimezone(config('app.timezone'))->format('Y-m-d');
            }
        } else {
            // Jika kandidat belum ada, siapkan state dengan data kosong
            $this->state = [
                'nama_depan' => '',
                'nama_tengah' => '',
                'nama_belakang' => '',
                'no_telpon' => '',
                'no_telpon_alternatif' => '',
                'alamat' => '',
                'kota' => '',
                'kode_pos' => '',
                'negara' => 'Indonesia',
                'no_ktp' => '',
                'no_npwp' => '',
                'tempat_lahir' => '',
                'tanggal_lahir' => '',
                'jenis_kelamin' => '',
                'status_perkawinan' => '',
                'agama' => '',
                'pengalaman_kerja' => [
                    ['tanggal_mulai' => '', 'tanggal_selesai' => '', 'nama_perusahaan' => '', 'keterangan_bisnis' => '', 'jabatan' => '', 'alasan_keluar' => ''],
                ],
                'pendidikan' => [
                    ['tanggal_mulai' => '', 'tanggal_selesai' => '', 'nama_pendidikan' => '', 'jurusan' => '', 'tingkat' => '', 'pendidikan_tertinggi' => 'Tidak'],
                ],
                'kemampuan_bahasa' => [
                    ['bahasa' => '', 'bicara' => '', 'membaca' => '', 'menulis' => ''],
                ],
                'kemampuan' => '',
                'pernah_bekerja' => '',
                'lokasi_bekerja' => '',
                'sumber_informasi' => '',
            ];
        }
    }

    /**
     * Add a new empty work experience entry.
     */
    public function addWorkExperience()
    {
        $this->state['pengalaman_kerja'][] = ['tanggal_mulai' => '', 'tanggal_selesai' => '', 'nama_perusahaan' => '', 'keterangan_bisnis' => '', 'jabatan' => '', 'alasan_keluar' => ''];
    }

    public function removeWorkExperience($index)
    {
        unset($this->state['pengalaman_kerja'][$index]);
        $this->state['pengalaman_kerja'] = array_values($this->state['pengalaman_kerja']);
    }

    public function addEducation()
    {
        $this->state['pendidikan'][] = ['tanggal_mulai' => '', 'tanggal_selesai' => '', 'nama_pendidikan' => '', 'jurusan' => '', 'tingkat' => '', 'pendidikan_tertinggi' => 'Tidak'];
    }

    public function removeEducation($index)
    {
        unset($this->state['pendidikan'][$index]);
        $this->state['pendidikan'] = array_values($this->state['pendidikan']);
    }

    public function addLanguage()
    {
        $this->state['kemampuan_bahasa'][] = ['bahasa' => '', 'bicara' => '', 'membaca' => '', 'menulis' => ''];
    }

    public function removeLanguage($index)
    {
        unset($this->state['kemampuan_bahasa'][$index]);
        $this->state['kemampuan_bahasa'] = array_values($this->state['kemampuan_bahasa']);
    }

    /**
     * Update the user's kandidat profile information.
     *
     * @return void
     */
    public function updateKandidatProfile()
    {
        $user = Auth::user();

        $validatedData = $this->validate([
            'state.nama_depan' => ['required', 'string', 'max:255'],
            'state.nama_tengah' => ['nullable', 'string', 'max:255'],
            'state.nama_belakang' => ['required', 'string', 'max:255'],
            'state.no_telpon' => ['required', 'string', 'max:20'],
            'state.no_telpon_alternatif' => ['nullable', 'string', 'max:20'],
            'state.alamat' => ['required', 'string'],
            'state.kota' => ['required', 'string', 'max:100'],
            'state.kode_pos' => ['required', 'string', 'max:10'],
            'state.negara' => ['required', 'string', 'max:100'],
            'state.no_ktp' => ['required', 'string', 'max:20', Rule::unique('kandidats', 'no_ktp')->ignore($user->kandidat->id ?? null)],
            'state.no_npwp' => ['nullable', 'string', 'max:25'],
            'state.tempat_lahir' => ['required', 'string', 'max:100'],
            'state.tanggal_lahir' => ['required', 'date'],
            'state.jenis_kelamin' => ['required', 'in:L,P'],
            'state.status_perkawinan' => ['required', 'string', 'max:50'],
            'state.agama' => ['required', 'string', 'max:50'],
            'state.pengalaman_kerja' => ['nullable', 'array'],
            'state.pengalaman_kerja.*.tanggal_mulai' => ['nullable', 'date'],
            'state.pengalaman_kerja.*.tanggal_selesai' => ['nullable', 'date'],
            'state.pengalaman_kerja.*.nama_perusahaan' => ['nullable', 'string', 'max:255'],
            'state.pengalaman_kerja.*.keterangan_bisnis' => ['nullable', 'string', 'max:255'],
            'state.pengalaman_kerja.*.jabatan' => ['nullable', 'string', 'max:255'],
            'state.pengalaman_kerja.*.alasan_keluar' => ['nullable', 'string', 'max:255'],
            'state.pendidikan' => ['nullable', 'array'],
            'state.pendidikan.*.tanggal_mulai' => ['nullable', 'date'],
            'state.pendidikan.*.tanggal_selesai' => ['nullable', 'date'],
            'state.pendidikan.*.nama_pendidikan' => ['nullable', 'string', 'max:255'],
            'state.pendidikan.*.jurusan' => ['nullable', 'string', 'max:255'],
            'state.pendidikan.*.tingkat' => ['nullable', 'string', 'max:100'],
            'state.pendidikan.*.pendidikan_tertinggi' => ['nullable', 'string', 'max:100'],
            'state.kemampuan_bahasa' => ['nullable', 'array'],
            'state.kemampuan_bahasa.*.bahasa' => ['nullable', 'string', 'max:100'],
            'state.kemampuan_bahasa.*.bicara' => ['nullable', 'string', 'max:100'],
            'state.kemampuan_bahasa.*.membaca' => ['nullable', 'string', 'max:100'],
            'state.kemampuan_bahasa.*.menulis' => ['nullable', 'string', 'max:100'],
            'state.kemampuan' => ['nullable', 'string'],
            'state.pernah_bekerja' => ['nullable', 'string', 'max:100'],
            'state.lokasi_bekerja' => ['nullable', 'string', 'max:255'],
            'state.sumber_informasi' => ['nullable', 'string', 'max:255'],
        ]);

        $state = $validatedData['state'];
        $state['pengalaman_kerja'] = json_encode($state['pengalaman_kerja']);
        $state['pendidikan'] = json_encode($state['pendidikan']);
        $state['kemampuan_bahasa'] = json_encode($state['kemampuan_bahasa']);

        // Gunakan updateOrCreate untuk membuat profil jika belum ada, atau memperbarui jika sudah ada
        Kandidat::updateOrCreate(
            ['user_id' => $user->id],
            $state
        );

        // Beri feedback ke pengguna
        $this->dispatch('saved');

        // Refresh state jika diperlukan (opsional, tergantung UX)
        // $this->state = $user->fresh()->kandidat->toArray();

        // Bisa juga dengan flash message jika halaman direfresh
        session()->flash('status', 'Profil kandidat berhasil diperbarui.');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.profile.update-kandidat-profile-form');
    }
}