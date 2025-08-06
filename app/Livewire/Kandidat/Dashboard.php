<?php

namespace App\Livewire\Kandidat;

use App\Models\LamarLowongan;
use Livewire\Component;
use App\Models\Lowongan;
use App\Models\Kandidat;
use App\Models\BmiTest;
use App\Models\BlindTest;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $showJobModal = false;
    public $showProfileModal = false;
    public $showBmiTestModal = false;
    public $showBlindTestModal = false;
    public $selectedLowongan;
    
    // Properti untuk form kandidat
    public $nama_depan;
    public $nama_belakang;
    public $no_telpon;
    public $no_telpon_alternatif;
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
    public $pendidikan;
    public $pengalaman_kerja;
    public $kemampuan_bahasa;
    public $kemampuan;
    
    // Properti untuk BMI Test
    public $tinggi_badan;
    public $berat_badan;

    // Properti untuk Blind Test
    public $blind_test_answers = [];
    public $blind_score;
    public $current_blind_test = 1;
    public $total_blind_tests = 5; 
    public $blind_test_options = [];

    protected $correct_blind_test_answers = [ 1 => '8', 2 => '29', 3 => '5', 4 => '6', 5 => '42' ];

    protected $all_blind_test_options = [
        1 => ['A' => '3', 'B' => '8', 'C' => '5', 'D' => 'Tidak ada'],
        2 => ['A' => '70', 'B' => '79', 'C' => '29', 'D' => 'Tidak ada'],
        3 => ['A' => '5', 'B' => '3', 'C' => '6', 'D' => 'Tidak ada'],
        4 => ['A' => '6', 'B' => '8', 'C' => '5', 'D' => 'Tidak ada'],
        5 => ['A' => '47', 'B' => '42', 'C' => '72', 'D' => 'Tidak ada'],
    ];

    protected function rules()
    {
        $user = Auth::user();
        
        return [
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'no_telpon' => 'required|string|max:20',
            'no_telpon_alternatif' => 'required|string|max:20',
            'alamat' => 'required|string',
            'kode_pos' => 'required|string|max:10',
            'negara' => 'required|string|max:100',
            'no_ktp' => 'required|string|max:20|unique:kandidats,no_ktp' . ($user && $user->kandidat ? ',' . $user->kandidat->id : ''),
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'status_perkawinan' => 'required|string|max:50',
            'agama' => 'required|string|max:50',
            'pendidikan' => 'required|string',
            'no_npwp' => 'nullable|string|max:25',
            'pengalaman_kerja' => 'nullable|string',
            'kemampuan_bahasa' => 'nullable|string',
            'kemampuan' => 'nullable|string',
            'tinggi_badan' => 'required|numeric|min:100|max:250',
            'berat_badan' => 'required|numeric|min:30|max:200',
        ];
    }
    protected $bmiRules = [
        'tinggi_badan' => 'required|numeric|min:100|max:250',
        'berat_badan' => 'required|numeric|min:30|max:200',
    ];
    public function mount()
    {
        // Inisialisasi opsi untuk soal pertama
        $this->blind_test_options = $this->all_blind_test_options[$this->current_blind_test];
        
        // Load existing profile data if available
        $user = Auth::user();
        if ($user && $user->kandidat) {
            $kandidat = $user->kandidat;
            $this->fill($kandidat->toArray()); // Cara lebih ringkas untuk mengisi properti
            $this->tanggal_lahir = $kandidat->tanggal_lahir ? $kandidat->tanggal_lahir->format('Y-m-d') : '';
        }

        //  $this->profileRules = [
        //     'nama_depan' => 'required|string|max:255',
        //     'nama_belakang' => 'required|string|max:255',
        //     'no_telpon' => 'required|string|max:20',
        //     'alamat' => 'required|string',
        //     'kode_pos' => 'required|string|max:10',
        //     'negara' => 'required|string|max:100',
        //     'no_ktp' => 'required|string|max:20|unique:kandidats,no_ktp' . ($user && $user->kandidat ? ',' . $user->kandidat->id : ''),
        //     'tempat_lahir' => 'required|string|max:100',
        //     'tanggal_lahir' => 'required|date',
        //     'jenis_kelamin' => 'required|in:L,P',
        //     'status_perkawinan' => 'required|string|max:50',
        //     'agama' => 'required|string|max:50',
        //     'pendidikan' => 'required|string',
        //     'no_npwp' => 'nullable|string|max:25',
        //     'pengalaman_kerja' => 'nullable|string',
        //     'kemampuan_bahasa' => 'nullable|string',
        //     'kemampuan' => 'nullable|string',
        // ];
    }

    public function showJob($lowonganId)
    {
        $this->selectedLowongan = Lowongan::find($lowonganId);
        $user = Auth::user();

        // Alur pengecekan sekarang menggunakan relasi
        if (!$user->kandidat) {
            $this->showBmiTestModal = true;
            return;
        }

        $kandidat = $user->kandidat;
        if (!$kandidat->bmiTest) $this->showBmiTestModal = true;
        elseif (!$kandidat->blindTest) $this->showBlindTestModal = true;
        else $this->showJobModal = true;
    }

    public function calculateBmi()
    {
        $this->validate($this->bmiRules);
        
        $tinggiMeter = $this->tinggi_badan / 100;
        $score = round($this->berat_badan / ($tinggiMeter * $tinggiMeter), 1);
        
        if ($score < 18.5) $kategori = 'Kurus';
        elseif ($score <= 24.9) $kategori = 'Normal';
        else $kategori = 'Gemuk';
        
        $user = Auth::user();
        $kandidat = $user->kandidat;

        if (!$kandidat) {
            // Buat kandidat baru jika belum ada
            $kandidat = Kandidat::create([
                'user_id' => $user->id,
                'nama_depan' => $user->name, // Gunakan nama user sebagai default
                'nama_belakang' => '',
                'no_telpon' => '',
                'no_telpon_alternatif' => '',
                'alamat' => '',
                'kode_pos' => '',
                'negara' => '',
                'no_ktp' => '',
                'tempat_lahir' => '',
                'tanggal_lahir' => now(),
                'jenis_kelamin' => 'L',
                'status_perkawinan' => 'Belum Menikah',
                'agama' => '',
                'pendidikan' => ''
            ]);
            $user->refresh();
        }
        
        BmiTest::updateOrCreate(
            ['kandidat_id' => $kandidat->id],
            [
                'tinggi_badan' => $this->tinggi_badan,
                'berat_badan' => $this->berat_badan,
                'score' => $score,
                'kategori' => $kategori,
            ]
        );
        
        $this->showBmiTestModal = false;
        $this->showBlindTestModal = true;
    }

    public function submitBlindTestAnswer($option)
    {
        if (!isset($this->blind_test_options[$option])) return;
        $this->blind_test_answers[$this->current_blind_test] = $this->blind_test_options[$option];
        
        if ($this->current_blind_test < $this->total_blind_tests) {
            $this->current_blind_test++;
            $this->blind_test_options = $this->all_blind_test_options[$this->current_blind_test];
        } else {
            $correctCount = 0;
            foreach ($this->blind_test_answers as $number => $answer) {
                if (isset($this->correct_blind_test_answers[$number]) && $this->correct_blind_test_answers[$number] == $answer) {
                    $correctCount++;
                }
            }
            $score = round(($correctCount / $this->total_blind_tests) * 100, 0);

            $user = Auth::user();
            $kandidat = $user->kandidat;

            if (!$kandidat) {
                // Buat kandidat baru jika belum ada
                $kandidat = Kandidat::create([
                    'user_id' => $user->id,
                    'nama_depan' => $user->name, // Gunakan nama user sebagai default
                    'nama_belakang' => '',
                    'no_telpon' => '',
                    'no_telpon_alternatif' => '',
                    'alamat' => '',
                    'kode_pos' => '',
                    'negara' => '',
                    'no_ktp' => '',
                    'tempat_lahir' => '',
                    'tanggal_lahir' => now(),
                    'jenis_kelamin' => 'L',
                    'status_perkawinan' => 'Belum Menikah',
                    'agama' => '',
                    'pendidikan' => ''
                ]);
                $user->refresh();
            }

            // Simpan hasil ke tabel blind_tests
            BlindTest::updateOrCreate(
                ['kandidat_id' => $kandidat->id],
                [
                    'total_questions' => $this->total_blind_tests,
                    'correct_answers' => $correctCount,
                    'score' => $score,
                    'details' => $this->blind_test_answers,
                ]
            );

            $this->showBlindTestModal = false;
            $this->showProfileModal = true; // Tampilkan form profil setelah selesai tes
        }
    }

    public function showProfileForm()
    {
        $this->showProfileModal = true;
    }

    public function closeModal()
    {
        $this->showJobModal = false;
        $this->selectedLowongan = null;
    }

    public function closeBmiTest()
    {
        $this->showBmiTestModal = false;
        // Reset BMI values
        $this->reset(['tinggi_badan', 'berat_badan']);
        
        // Kembali ke dashboard tanpa melanjutkan proses
        if ($this->selectedLowongan) {
            $this->selectedLowongan = null;
        }
    }

    public function closeBlindTest()
    {
        $this->showBlindTestModal = false;
        // Reset blind test values
        $this->resetBlindTest();
        
        // Kembali ke dashboard tanpa melanjutkan proses
        if ($this->selectedLowongan) {
            $this->selectedLowongan = null;
        }
    }

    private function resetBlindTest()
    {
        $this->reset(['blind_test_answers', 'blind_score']);
        $this->current_blind_test = 1;
        $this->blind_test_options = $this->all_blind_test_options[$this->current_blind_test];
    }

    public function closeProfileForm()
    {
        $this->showProfileModal = false;
        $this->resetProfileForm();
    }

    public function resetProfileForm()
    {
        $this->resetValidation();
        // Don't reset values if user already has profile data
        $user = Auth::user();
        if (!$user || !$user->kandidat) {
            $this->reset([
                'nama_depan', 'nama_belakang', 'no_telpon', 'alamat', 'kode_pos', 'negara',
                'no_ktp', 'no_npwp', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
                'status_perkawinan', 'agama', 'pendidikan', 'pengalaman_kerja',
                'kemampuan_bahasa', 'kemampuan'
            ]);
        }
    }

    public function saveProfile()
    {
        $validatedData = $this->validate($this->rules());
        $user = Auth::user();

        $kandidat = Kandidat::updateOrCreate(['user_id' => $user->id], $validatedData);
        
        if($kandidat) {
            $this->closeProfileForm();
            $user->refresh();
            $this->showBmiTestModal = true;
            session()->flash('success', 'Profil berhasil disimpan! Silakan lanjutkan ke Tes BMI.');
        } else {
            session()->flash('error', 'Gagal menyimpan profil.');
        }
    }

    public function applyJob($lowonganId)
    {
        $user = Auth::user();
        $kandidat = $user->kandidat;

        if (!$kandidat) {
            session()->flash('error', 'Profil kandidat tidak ditemukan.');
            $this->closeModal();
            return;
        }

        $existingApplication = LamarLowongan::where('kandidat_id', $kandidat->id)
            ->where('lowongan_id', $lowonganId)->first();

        if ($existingApplication) {
            session()->flash('error', 'Anda sudah pernah melamar untuk posisi ini.');
            $this->closeModal();
            return;
        }

        try {
            LamarLowongan::create([
                'kandidat_id' => $kandidat->id,
                'lowongan_id' => $lowonganId,
                'status' => 'pending',
            ]);

            session()->flash('success', 'Lamaran berhasil dikirim!');
            $this->closeModal();
            return redirect()->route('kandidat.lowongan-dilamar');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal mengirim lamaran: ' . $e->getMessage());
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.kandidat.dashboard', [
            'lowonganTerbaru' => Lowongan::where('status', 'posted')
                ->where('tanggal_berakhir', '>=', now())
                ->with('kategoriLowongan')
                ->latest('tanggal_posting')
                ->paginate(6)
        ]);
    }
}