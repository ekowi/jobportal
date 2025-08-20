<?php

namespace App\Livewire\Kandidat;

use App\Models\LamarLowongan;
use Livewire\Component;
use App\Models\Lowongan;
use App\Models\Kandidat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Dashboard extends Component
{
    use WithPagination, WithFileUploads;

    public $showJobModal = false;
    public $showProfileModal = false;
    public $showBmiTestModal = false;
    public $showBlindTestModal = false;
    public $showResultModal = false;
    public $showDocumentModal = false;
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
    public $testResults = [];
    public $requiredDocuments = [];
    public $missingDocuments = [];
    public $documents = [];

    // Uploaded document placeholders
    public $ktp;
    public $ijazah;
    public $sertifikat;
    public $surat_pengalaman;
    public $skck;
    public $surat_sehat;

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
        
        // Cek dan impor data tes dari local storage jika user baru login
        if (Auth::check() && !session()->has('imported_test_data')) {
            $this->dispatch('get-test-data');
            session(['imported_test_data' => true]);
        }
    }

    public function showJob($lowonganId)
    {
        $this->selectedLowongan = Lowongan::find($lowonganId);

        if (Auth::check()) {
            // Alur untuk pengguna yang sudah login (tetap sama)
            $user = Auth::user();
            if (!$user->kandidat) $this->showProfileModal = true;
            elseif (!$user->kandidat->bmi_score) $this->showBmiTestModal = true;
            elseif (!$user->kandidat->blind_score) $this->showBlindTestModal = true;
            elseif (!$this->hasRequiredDocuments($this->selectedLowongan))
                $this->openDocumentModal();
            else $this->showJobModal = true;
        } else {
            // Alur untuk pengguna tamu: langsung mulai tes
            $this->startGuestTestFlow(['jobId' => $lowonganId]);
        }
    }


    public function calculateBmi()
    {
        $validatedData = $this->validate($this->bmiRules);

        $tinggiMeter = $validatedData['tinggi_badan'] / 100;
        $score = round($validatedData['berat_badan'] / ($tinggiMeter * $tinggiMeter), 1);
        $kategori = ($score < 18.5) ? 'Kurus' : (($score <= 24.9) ? 'Normal' : 'Gemuk');

        if (Auth::check()) {
            $kandidat = Auth::user()->kandidat ?? Kandidat::create(['user_id' => Auth::id()]);
            $kandidat->update(['bmi_score' => $score]);
        } else {
            // Simpan data BMI ke sesi server untuk tamu
            $bmiData = array_merge($validatedData, ['score' => $score, 'kategori' => $kategori]);
            session(['guest_test_data.bmi' => $bmiData]);
        }
        
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
                if (($this->correct_blind_test_answers[$number] ?? null) == $answer) {
                    $correctCount++;
                }
            }
            $score = round(($correctCount / $this->total_blind_tests) * 100, 0);

            if (Auth::check()) {
            $kandidat = Auth::user()->kandidat ?? Kandidat::create(['user_id' => Auth::id()]);
            $kandidat->update(['blind_score' => $score]);
            $this->showBlindTestModal = false;
            $this->showProfileModal = true;
        } else {
            // Simpan data Blind Test ke sesi server
            $blindTestData = [
                'total_questions' => $this->total_blind_tests,
                'correct_answers' => $correctCount,
                'score' => $score,
                'details' => $this->blind_test_answers,
            ];

            $results = [
                'bmi' => session('guest_test_data.bmi'),
                'blind' => $blindTestData,
            ];

            session(['guest_test_data' => $results]);
            $this->testResults = $results;
            $this->showBlindTestModal = false;
            $this->showResultModal = true;

            $this->dispatch('store-test-results', $results);
        }
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

    public function closeResultModal()
    {
        $this->showResultModal = false;

        $meetsBmi = isset($this->testResults['bmi']) &&
            ($this->testResults['bmi']['kategori'] === 'Normal');
        $meetsBlind = isset($this->testResults['blind']) &&
            ($this->testResults['blind']['score'] >= 60);

        if ($meetsBmi && $meetsBlind) {
            $this->dispatch('prompt-auth-after-test');
        }
    }

    public function openDocumentModal()
    {
        $this->resetUploadFields();
        $this->refreshDocuments();
        $this->showDocumentModal = true;
    }

    public function closeDocumentModal()
    {
        $this->showDocumentModal = false;
    }

    protected function resetUploadFields()
    {
        $this->ktp = $this->ijazah = $this->sertifikat = $this->surat_pengalaman = $this->skck = $this->surat_sehat = null;
    }

    protected function getUserDocuments()
    {
        $userId = Auth::id();
        $path = "documents/{$userId}";
        $files = [];
        if (Storage::disk('public')->exists($path)) {
            foreach (Storage::disk('public')->files($path) as $file) {
                $name = pathinfo($file, PATHINFO_FILENAME);
                $files[$name] = Storage::url($file);
            }
        }
        return $files;
    }

    protected function refreshDocuments()
    {
        $this->documents = $this->getUserDocuments();
    }

    protected function hasRequiredDocuments($lowongan)
    {
        $this->requiredDocuments = $lowongan->dokumen_pendukung ?? [];
        $userDocs = $this->getUserDocuments();
        $this->missingDocuments = [];
        foreach ($this->requiredDocuments as $doc) {
            if (!isset($userDocs[$doc])) {
                $this->missingDocuments[] = $doc;
            }
        }
        return empty($this->missingDocuments);
    }

    public function uploadDocuments()
    {
        $userId = Auth::id();
        $basePath = "documents/{$userId}";

        if ($this->ktp) {
            $this->ktp->storeAs($basePath, 'ktp.' . $this->ktp->getClientOriginalExtension(), 'public');
        }
        if ($this->ijazah) {
            $this->ijazah->storeAs($basePath, 'ijazah.' . $this->ijazah->getClientOriginalExtension(), 'public');
        }
        if ($this->sertifikat) {
            $this->sertifikat->storeAs($basePath, 'sertifikat.' . $this->sertifikat->getClientOriginalExtension(), 'public');
        }
        if ($this->surat_pengalaman) {
            $this->surat_pengalaman->storeAs($basePath, 'surat_pengalaman.' . $this->surat_pengalaman->getClientOriginalExtension(), 'public');
        }
        if ($this->skck) {
            $this->skck->storeAs($basePath, 'skck.' . $this->skck->getClientOriginalExtension(), 'public');
        }
        if ($this->surat_sehat) {
            $this->surat_sehat->storeAs($basePath, 'surat_sehat.' . $this->surat_sehat->getClientOriginalExtension(), 'public');
        }

        $this->refreshDocuments();
        $this->closeDocumentModal();

        if ($this->selectedLowongan && $this->hasRequiredDocuments($this->selectedLowongan)) {
            $this->showJobModal = true;
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

    protected $listeners = [
        'start-guest-test-flow' => 'startGuestTestFlow',
        'show-cached-results' => 'showCachedResults',
    ];

    public function startGuestTestFlow($data = [])
    {
        if (session()->has('guest_test_data')) {
            $this->testResults = session('guest_test_data');
            $this->showResultModal = true;
            return;
        }

        if (isset($data['jobId'])) {
            $this->selectedLowongan = Lowongan::find($data['jobId']);
            // Simpan ID lowongan di sesi untuk tamu
            session(['guest_application_job_id' => $data['jobId']]);
        }
        $this->showBmiTestModal = true;
    }

    public function showCachedResults($data)
    {
        if (!$data) return;

        $this->testResults = $data;
        $this->showResultModal = true;
    }

    public function importTestData($data)
    {
        if (!Auth::check() || !isset($data['bmi']) || !isset($data['blind'])) return;
        
        $user = Auth::user();
        $kandidat = $user->kandidat ?? Kandidat::create(['user_id' => $user->id]);
        // Import BMI test data
        if (!$kandidat->bmi_score && $data['bmi']) {
            $kandidat->bmi_score = $data['bmi']['score'];
        }

        // Import Blind test data
        if (!$kandidat->blind_score && $data['blind']) {
            $kandidat->blind_score = $data['blind']['score'];
        }

        $kandidat->save();
        
        // Clear local storage after import
        $this->dispatch('clear-test-data');
    }
}