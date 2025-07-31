<?php

namespace App\Livewire\Kandidat;

use App\Models\LamarLowongan;
use Livewire\Component;
use App\Models\Lowongan;
use App\Models\Lamaran;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination; // 1. Tambahkan trait untuk paginasi

class Dashboard extends Component
{
    use WithPagination; // 2. Gunakan trait paginasi

    // Properti untuk mengontrol modal
    public $showJobModal = false;
    public $selectedLowongan;

    /**
     * Metode ini akan dipanggil saat kandidat mengklik sebuah lowongan.
     * Fungsinya adalah mengambil data lowongan dari database berdasarkan ID,
     * menyimpannya di properti, dan memberi sinyal untuk menampilkan modal.
     */
    public function showJob($lowonganId)
    {
        $this->selectedLowongan = Lowongan::find($lowonganId);
        $this->showJobModal = true;
    }

    /**
     * Metode ini akan dipanggil untuk menutup modal.
     */
    public function closeModal()
    {
        $this->showJobModal = false;
        $this->selectedLowongan = null; // Kosongkan data agar tidak tampil di modal lain kali
    }

    /**
     * Metode render mengambil data lowongan dan menampilkannya di view.
     */
    public function render()
    {
        return view('livewire.kandidat.dashboard', [
            'lowonganTerbaru' => Lowongan::where('status', 'posted')
                ->where('tanggal_berakhir', '>=', now())
                ->with('kategoriLowongan')
                ->latest('tanggal_posting')
                ->paginate(6) // 3. Ganti take(4)->get() menjadi paginate()
        ]);
    }

    public function applyJob($lowonganId)
    {
        $user = Auth::user();
        
        // Check if already applied
        $existingApplication = LamarLowongan::where('kandidat_id', $user->id)
            ->where('lowongan_id', $lowonganId)
            ->first();

        if ($existingApplication) {
            session()->flash('error', 'Anda sudah pernah melamar untuk posisi ini.');
            return;
        }

        // Create new application
        LamarLowongan::create([
            'user_id' => $user->id,
            'lowongan_id' => $lowonganId,
            'status' => 'pending',
        ]);

        session()->flash('success', 'Lamaran berhasil dikirim!');
        $this->closeModal();

        // Redirect to lowongan-dilamar
        return redirect()->route('kandidat.lowongan-dilamar');
    }
}
