<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriSoal;

class KategoriSoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Hapus data lama jika ada untuk menghindari duplikasi
        // KategoriSoal::truncate();

        $kategoriList = [
            [
                'nama_kategori' => 'Tes Logika',
                'deskripsi' => 'Soal-soal yang menguji kemampuan penalaran dan logika dasar.',
                'status' => true,
            ],
            [
                'nama_kategori' => 'Pengetahuan Umum',
                'deskripsi' => 'Soal-soal mengenai wawasan umum, sejarah, dan isu terkini.',
                'status' => true,
            ],
            [
                'nama_kategori' => 'Matematika Dasar',
                'deskripsi' => 'Soal-soal yang berkaitan dengan kemampuan aritmatika dan matematika dasar.',
                'status' => true,
            ],
            [
                'nama_kategori' => 'Tes Kepribadian',
                'deskripsi' => 'Soal untuk mengukur aspek psikologis dan kepribadian kandidat.',
                'status' => false, // Contoh kategori non-aktif
            ],
        ];

        foreach ($kategoriList as $kategori) {
            KategoriSoal::create($kategori);
        }
    }
}
