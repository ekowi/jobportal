<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriLowongan;

class KategoriLowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Baris ini opsional, berguna untuk menghapus data lama sebelum seeding
        // agar tidak ada data duplikat jika seeder dijalankan berulang kali.
        // KategoriLowongan::truncate();

        $kategoriList = [
            [
                'nama_kategori' => 'Teknologi Informasi',
                'deskripsi' => 'Lowongan terkait pengembangan perangkat lunak, infrastruktur IT, dan keamanan siber.',
                'logo' => null,
                'is_active' => true,
                'user_create' => 1, // Asumsi user ID 1 adalah admin/sistem
                'user_update' => 1,
            ],
            [
                'nama_kategori' => 'Pemasaran & Penjualan',
                'deskripsi' => 'Pekerjaan di bidang digital marketing, branding, manajemen penjualan, dan business development.',
                'logo' => null,
                'is_active' => true,
                'user_create' => 1,
                'user_update' => 1,
            ],
            [
                'nama_kategori' => 'Keuangan & Akuntansi',
                'deskripsi' => 'Lowongan untuk akuntan, analis keuangan, auditor, dan manajer keuangan.',
                'logo' => null,
                'is_active' => true,
                'user_create' => 1,
                'user_update' => 1,
            ],
            [
                'nama_kategori' => 'Sumber Daya Manusia',
                'deskripsi' => 'Pekerjaan yang berfokus pada rekrutmen, pelatihan, dan manajemen talenta.',
                'logo' => null,
                'is_active' => true,
                'user_create' => 1,
                'user_update' => 1,
            ],
            [
                'nama_kategori' => 'Desain & Kreatif',
                'deskripsi' => 'Lowongan untuk desainer grafis, UI/UX designer, content creator, dan videographer.',
                'logo' => null,
                'is_active' => false, // Contoh kategori yang tidak aktif
                'user_create' => 1,
                'user_update' => 1,
            ],
        ];

        foreach ($kategoriList as $kategori) {
            KategoriLowongan::create($kategori);
        }
    }
}