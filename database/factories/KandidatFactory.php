<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kandidat>
 */
class KandidatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // --- Data sampel untuk kolom JSON ---
        $riwayatKerja = [
            [
                'position' => 'Software Engineer',
                'company' => 'PT Teknologi Maju',
                'start' => '2020-01-01',
                'end' => '2023-12-31',
                'business' => 'IT',
                'reason' => 'Mencari tantangan baru'
            ]
        ];

        $riwayatPendidikan = [
            [
                'name' => 'Universitas Koding Indonesia',
                'major' => 'Teknik Informatika',
                'level' => 'S1',
                'start' => '2015-09-01',
                'end' => '2019-08-30',
                'highest' => true
            ]
        ];

        $kemampuanBahasa = [
            [
                'language' => 'Indonesia',
                'speaking' => 'Native',
                'reading' => 'Native',
                'writing' => 'Native'
            ],
            [
                'language' => 'English',
                'speaking' => 'Intermediate',
                'reading' => 'Advanced',
                'writing' => 'Intermediate'
            ]
        ];

        $infoSpesifik = [
            'pernah' => 'Tidak',
            'lokasi' => null,
            'info' => 'Website Perusahaan'
        ];
        
        // --- Definisi Factory ---
        return [
            'user_id' => User::factory()->state(['role' => 'kandidat']),
            'nama_depan' => $this->faker->firstName(),
            'nama_belakang' => $this->faker->lastName(),
            'no_telpon' => $this->faker->unique()->phoneNumber(),
            'alamat' => $this->faker->address(),
            'kode_pos' => $this->faker->postcode(),
            'negara' => 'Indonesia',
            'no_ktp' => $this->faker->unique()->numerify('################'), // 16 digit
            'no_npwp' => $this->faker->unique()->numerify('##.###.###.#-###.###'),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'status_perkawinan' => $this->faker->randomElement(['Belum Menikah', 'Menikah', 'Cerai Hidup', 'Cerai Mati']),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Hindu', 'Buddha', 'Konghucu']),
            'bmi_score' => $this->faker->randomFloat(2, 18.0, 25.0),
            'blind_score' => $this->faker->numberBetween(90, 100), // Skor dalam persen
            'no_telpon_alternatif' => $this->faker->phoneNumber(),
            'pendidikan' => $this->faker->randomElement(['SMA/SMK', 'D3', 'S1', 'S2']),
            'kemampuan' => $this->faker->bs(),
            
            // Mengisi kolom JSON dengan data yang sudah di-encode
            'riwayat_pengalaman_kerja' => json_encode($riwayatKerja),
            'riwayat_pendidikan' => json_encode($riwayatPendidikan),
            'kemampuan_bahasa' => json_encode($kemampuanBahasa),
            'informasi_spesifik' => json_encode($infoSpesifik),

            // Menggunakan user yang sudah ada secara acak sebagai pembuat
            'user_create' => User::inRandomOrder()->first()->id ?? User::factory(),
            'user_update' => null, // Biarkan null saat pembuatan awal
        ];
    }
}