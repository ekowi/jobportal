<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Kandidat;
use App\Models\LamarLowongan;
use Illuminate\Support\Facades\Session;

class ProcessGuestTestData
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if (Session::has('guest_test_data')) {
            $user = $event->user;
            $testData = Session::get('guest_test_data');
            $kandidat = Kandidat::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_depan' => $user->name,
                    'bmi_score' => $testData['bmi']['score'] ?? null,
                    'blind_score' => $testData['blind']['score'] ?? null,
                ]
            );

            // Simpan data BMI jika ada di sesi dan belum ada di DB
            if (isset($testData['bmi']) && !$kandidat->bmi_score) {
                $kandidat->bmi_score = $testData['bmi']['score'];
            }

            // Simpan data Blind Test jika ada di sesi dan belum ada di DB
            if (isset($testData['blind']) && !$kandidat->blind_score) {
                $kandidat->blind_score = $testData['blind']['score'];
            }

            $kandidat->save();
            
            // Jika ada ID lowongan, lamarkan pekerjaan
            $jobId = Session::get('guest_application_job_id');
            if ($jobId) {
                 LamarLowongan::firstOrCreate(
                    ['kandidat_id' => $kandidat->id, 'lowongan_id' => $jobId],
                    ['status' => 'pending']
                 );
            }

            // Hapus data dari sesi agar tidak diproses lagi
            Session::forget(['guest_test_data', 'guest_application_job_id']);

            Session::flash('success', 'Selamat datang! Hasil tes Anda telah berhasil disimpan.');
        }
    }
}