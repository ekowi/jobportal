<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Soal;
use App\Models\KategoriSoal;
use App\Models\User;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Mengambil kategori yang sudah dibuat oleh KategoriSoalSeeder
        $kategoriLogika = KategoriSoal::where('nama_kategori', 'Tes Logika')->first();
        $kategoriUmum = KategoriSoal::where('nama_kategori', 'Pengetahuan Umum')->first();
        $kategoriMatematika = KategoriSoal::where('nama_kategori', 'Matematika Dasar')->first();
        $kategoriKepribadian = KategoriSoal::where('nama_kategori', 'Tes Kepribadian')->first();
        
        // Mengambil user pertama yang ada di database untuk mengisi kolom 'pembuat'
        $user = User::first();
        $pembuat = $user ? $user->name : 'Admin Seeder';

        // Hanya lanjut jika kategori ditemukan
        if (!$kategoriLogika || !$kategoriUmum || !$kategoriMatematika || !$kategoriKepribadian) {
            $this->command->info('Kategori soal tidak ditemukan. Pastikan KategoriSoalSeeder sudah dijalankan terlebih dahulu.');
            return;
        }

        $soalList = [
            // Kategori Logika (10 Soal)
            [
                'id_kategori_soal' => $kategoriLogika->id_kategori_soal,
                'soal' => 'Semua mamalia menyusui. Paus adalah mamalia. Kesimpulannya adalah...',
                'pilihan_1' => 'Paus tidak menyusui',
                'pilihan_2' => 'Paus bertelur',
                'pilihan_3' => 'Paus menyusui',
                'pilihan_4' => 'Paus adalah ikan',
                'jawaban' => 3,
            ],
            [
                'id_kategori_soal' => $kategoriLogika->id_kategori_soal,
                'soal' => 'Seri angka: 2, 4, 8, 16, ... Angka selanjutnya adalah?',
                'pilihan_1' => '24',
                'pilihan_2' => '32',
                'pilihan_3' => '64',
                'pilihan_4' => '20',
                'jawaban' => 2,
            ],
            [
                'id_kategori_soal' => $kategoriLogika->id_kategori_soal,
                'soal' => 'Jika API berhubungan dengan PANAS, maka ES berhubungan dengan...',
                'pilihan_1' => 'AIR',
                'pilihan_2' => 'KERAS',
                'pilihan_3' => 'BEKU',
                'pilihan_4' => 'DINGIN',
                'jawaban' => 4,
            ],
            [
                'id_kategori_soal' => $kategoriLogika->id_kategori_soal,
                'soal' => 'Beberapa siswa suka sepak bola. Semua siswa yang suka sepak bola juga suka basket. Maka...',
                'pilihan_1' => 'Semua siswa suka basket',
                'pilihan_2' => 'Beberapa siswa suka basket',
                'pilihan_3' => 'Tidak ada siswa yang suka basket',
                'pilihan_4' => 'Siswa yang tidak suka sepak bola, tidak suka basket',
                'jawaban' => 2,
            ],
            [
                'id_kategori_soal' => $kategoriLogika->id_kategori_soal,
                'soal' => 'Seri huruf: A, C, F, J, ... Huruf selanjutnya adalah?',
                'pilihan_1' => 'L',
                'pilihan_2' => 'M',
                'pilihan_3' => 'N',
                'pilihan_4' => 'O',
                'jawaban' => 4,
            ],
            [
                'id_kategori_soal' => $kategoriLogika->id_kategori_soal,
                'soal' => 'Kaki berhubungan dengan Sepatu, sebagaimana Tangan berhubungan dengan ...',
                'pilihan_1' => 'Jari',
                'pilihan_2' => 'Cincin',
                'pilihan_3' => 'Sarung Tangan',
                'pilihan_4' => 'Jam',
                'jawaban' => 3,
            ],
            [
                'id_kategori_soal' => $kategoriLogika->id_kategori_soal,
                'soal' => 'Mana yang berbeda dari yang lain?',
                'pilihan_1' => 'Singa',
                'pilihan_2' => 'Harimau',
                'pilihan_3' => 'Elang',
                'pilihan_4' => 'Kucing',
                'jawaban' => 3,
            ],
            [
                'id_kategori_soal' => $kategoriLogika->id_kategori_soal,
                'soal' => 'Jika hari ini adalah hari Rabu, maka lusa adalah hari ...',
                'pilihan_1' => 'Kamis',
                'pilihan_2' => 'Jumat',
                'pilihan_3' => 'Sabtu',
                'pilihan_4' => 'Selasa',
                'jawaban' => 2,
            ],
            [
                'id_kategori_soal' => $kategoriLogika->id_kategori_soal,
                'soal' => 'Semua dokter adalah orang pintar. Beberapa orang pintar suka membaca. Jadi...',
                'pilihan_1' => 'Semua dokter suka membaca',
                'pilihan_2' => 'Beberapa dokter suka membaca',
                'pilihan_3' => 'Tidak ada dokter yang suka membaca',
                'pilihan_4' => 'Tidak dapat disimpulkan',
                'jawaban' => 4,
            ],
            [
                'id_kategori_soal' => $kategoriLogika->id_kategori_soal,
                'soal' => 'Seri angka: 1, 1, 2, 3, 5, 8, ... Angka selanjutnya adalah?',
                'pilihan_1' => '11',
                'pilihan_2' => '12',
                'pilihan_3' => '13',
                'pilihan_4' => '14',
                'jawaban' => 3,
            ],

            // Kategori Pengetahuan Umum (10 Soal)
            [
                'id_kategori_soal' => $kategoriUmum->id_kategori_soal,
                'soal' => 'Sungai terpanjang di dunia adalah...',
                'pilihan_1' => 'Sungai Amazon',
                'pilihan_2' => 'Sungai Nil',
                'pilihan_3' => 'Sungai Yangtze',
                'pilihan_4' => 'Sungai Kapuas',
                'jawaban' => 2,
            ],
            [
                'id_kategori_soal' => $kategoriUmum->id_kategori_soal,
                'soal' => 'Gunung tertinggi di dunia adalah...',
                'pilihan_1' => 'Gunung Everest',
                'pilihan_2' => 'Gunung K2',
                'pilihan_3' => 'Gunung Kilimanjaro',
                'pilihan_4' => 'Gunung Jaya Wijaya',
                'jawaban' => 1,
            ],
            [
                'id_kategori_soal' => $kategoriUmum->id_kategori_soal,
                'soal' => 'Siapakah penemu bola lampu?',
                'pilihan_1' => 'Albert Einstein',
                'pilihan_2' => 'Alexander Graham Bell',
                'pilihan_3' => 'Thomas Edison',
                'pilihan_4' => 'Isaac Newton',
                'jawaban' => 3,
            ],
            [
                'id_kategori_soal' => $kategoriUmum->id_kategori_soal,
                'soal' => 'Lagu kebangsaan Indonesia adalah...',
                'pilihan_1' => 'Garuda Pancasila',
                'pilihan_2' => 'Indonesia Pusaka',
                'pilihan_3' => 'Hari Merdeka',
                'pilihan_4' => 'Indonesia Raya',
                'jawaban' => 4,
            ],
             [
                'id_kategori_soal' => $kategoriUmum->id_kategori_soal,
                'soal' => 'Benua terluas di dunia adalah...',
                'pilihan_1' => 'Afrika',
                'pilihan_2' => 'Eropa',
                'pilihan_3' => 'Asia',
                'pilihan_4' => 'Amerika',
                'jawaban' => 3,
            ],
            [
                'id_kategori_soal' => $kategoriUmum->id_kategori_soal,
                'soal' => 'Ibu kota negara Australia adalah...',
                'pilihan_1' => 'Sydney',
                'pilihan_2' => 'Melbourne',
                'pilihan_3' => 'Canberra',
                'pilihan_4' => 'Perth',
                'jawaban' => 3,
            ],
            [
                'id_kategori_soal' => $kategoriUmum->id_kategori_soal,
                'soal' => 'Planet terdekat dari Matahari adalah...',
                'pilihan_1' => 'Venus',
                'pilihan_2' => 'Merkurius',
                'pilihan_3' => 'Mars',
                'pilihan_4' => 'Bumi',
                'jawaban' => 2,
            ],
            [
                'id_kategori_soal' => $kategoriUmum->id_kategori_soal,
                'soal' => 'Proklamasi Kemerdekaan Indonesia dibacakan pada tahun...',
                'pilihan_1' => '1942',
                'pilihan_2' => '1945',
                'pilihan_3' => '1949',
                'pilihan_4' => '1950',
                'jawaban' => 2,
            ],
            [
                'id_kategori_soal' => $kategoriUmum->id_kategori_soal,
                'soal' => 'Candi Borobudur terletak di provinsi...',
                'pilihan_1' => 'DI Yogyakarta',
                'pilihan_2' => 'Jawa Timur',
                'pilihan_3' => 'Jawa Tengah',
                'pilihan_4' => 'Jawa Barat',
                'jawaban' => 3,
            ],
            [
                'id_kategori_soal' => $kategoriUmum->id_kategori_soal,
                'soal' => 'Mata uang negara Jepang adalah...',
                'pilihan_1' => 'Yuan',
                'pilihan_2' => 'Won',
                'pilihan_3' => 'Dollar',
                'pilihan_4' => 'Yen',
                'jawaban' => 4,
            ],

            // Kategori Matematika Dasar (10 Soal)
            [
                'id_kategori_soal' => $kategoriMatematika->id_kategori_soal,
                'soal' => 'Sebuah toko memberikan diskon 20% untuk sebuah baju seharga Rp 150.000. Berapa harga baju setelah diskon?',
                'pilihan_1' => 'Rp 100.000',
                'pilihan_2' => 'Rp 110.000',
                'pilihan_3' => 'Rp 120.000',
                'pilihan_4' => 'Rp 130.000',
                'jawaban' => 3,
            ],
            [
                'id_kategori_soal' => $kategoriMatematika->id_kategori_soal,
                'soal' => 'Hasil dari 1/2 + 1/4 adalah...',
                'pilihan_1' => '1/6',
                'pilihan_2' => '2/4',
                'pilihan_3' => '3/4',
                'pilihan_4' => '1/8',
                'jawaban' => 3,
            ],
            [
                'id_kategori_soal' => $kategoriMatematika->id_kategori_soal,
                'soal' => 'Jika sebuah mobil menempuh jarak 120 km dalam 2 jam, berapa kecepatannya?',
                'pilihan_1' => '50 km/jam',
                'pilihan_2' => '60 km/jam',
                'pilihan_3' => '70 km/jam',
                'pilihan_4' => '240 km/jam',
                'jawaban' => 2,
            ],
            [
                'id_kategori_soal' => $kategoriMatematika->id_kategori_soal,
                'soal' => 'Berapa 25% dari 200?',
                'pilihan_1' => '25',
                'pilihan_2' => '40',
                'pilihan_3' => '50',
                'pilihan_4' => '75',
                'jawaban' => 3,
            ],
            [
                'id_kategori_soal' => $kategoriMatematika->id_kategori_soal,
                'soal' => 'Sebuah persegi memiliki sisi 5 cm. Berapa luasnya?',
                'pilihan_1' => '10 cm²',
                'pilihan_2' => '15 cm²',
                'pilihan_3' => '20 cm²',
                'pilihan_4' => '25 cm²',
                'jawaban' => 4,
            ],
            [
                'id_kategori_soal' => $kategoriMatematika->id_kategori_soal,
                'soal' => 'Jika x + 7 = 15, maka nilai x adalah...',
                'pilihan_1' => '5',
                'pilihan_2' => '6',
                'pilihan_3' => '7',
                'pilihan_4' => '8',
                'jawaban' => 4,
            ],
            [
                'id_kategori_soal' => $kategoriMatematika->id_kategori_soal,
                'soal' => 'Budi membeli 3 buku dengan harga Rp 2.500 per buku. Berapa total yang harus dibayar?',
                'pilihan_1' => 'Rp 5.000',
                'pilihan_2' => 'Rp 7.500',
                'pilihan_3' => 'Rp 9.000',
                'pilihan_4' => 'Rp 6.500',
                'jawaban' => 2,
            ],
            [
                'id_kategori_soal' => $kategoriMatematika->id_kategori_soal,
                'soal' => 'Hasil dari 15 x 3 + 5 adalah...',
                'pilihan_1' => '50',
                'pilihan_2' => '60',
                'pilihan_3' => '70',
                'pilihan_4' => '80',
                'jawaban' => 1,
            ],
            [
                'id_kategori_soal' => $kategoriMatematika->id_kategori_soal,
                'soal' => 'Sebuah segitiga memiliki alas 10 cm dan tinggi 5 cm. Berapa luasnya?',
                'pilihan_1' => '25 cm²',
                'pilihan_2' => '50 cm²',
                'pilihan_3' => '75 cm²',
                'pilihan_4' => '100 cm²',
                'jawaban' => 1,
            ],
            [
                'id_kategori_soal' => $kategoriMatematika->id_kategori_soal,
                'soal' => 'Urutkan pecahan berikut dari yang terkecil: 1/2, 1/4, 1/3',
                'pilihan_1' => '1/2, 1/3, 1/4',
                'pilihan_2' => '1/3, 1/4, 1/2',
                'pilihan_3' => '1/4, 1/3, 1/2',
                'pilihan_4' => '1/4, 1/2, 1/3',
                'jawaban' => 3,
            ],
            [
                'id_kategori_soal' => $kategoriKepribadian->id_kategori_soal,
                'soal' => 'Ketika menghadapi masalah yang rumit, saya cenderung...',
                'pilihan_1' => 'Menganalisis semua detail terlebih dahulu sebelum bertindak.',
                'pilihan_2' => 'Langsung mencoba solusi pertama yang terpikirkan.',
                'pilihan_3' => 'Meminta pendapat dari orang lain.',
                'pilihan_4' => 'Menunggu dan berharap masalah selesai dengan sendirinya.',
                'jawaban' => 1, // Contoh jawaban, bisa disesuaikan
            ],
            [
                'id_kategori_soal' => $kategoriKepribadian->id_kategori_soal,
                'soal' => 'Dalam sebuah acara sosial atau pesta, saya lebih sering...',
                'pilihan_1' => 'Berbicara dengan banyak orang yang berbeda.',
                'pilihan_2' => 'Mengobrol dengan beberapa teman dekat saja.',
                'pilihan_3' => 'Mengamati dari kejauhan.',
                'pilihan_4' => 'Merasa lelah dan ingin cepat pulang.',
                'jawaban' => 1,
            ],
            [
                'id_kategori_soal' => $kategoriKepribadian->id_kategori_soal,
                'soal' => 'Saat membuat keputusan penting, saya lebih mengandalkan...',
                'pilihan_1' => 'Logika dan data yang ada.',
                'pilihan_2' => 'Perasaan dan intuisi saya.',
                'pilihan_3' => 'Saran dari keluarga atau teman.',
                'pilihan_4' => 'Pengalaman masa lalu.',
                'jawaban' => 1,
            ],
            [
                'id_kategori_soal' => $kategoriKepribadian->id_kategori_soal,
                'soal' => 'Saya merasa paling bersemangat ketika...',
                'pilihan_1' => 'Menyelesaikan tugas yang menantang sendirian.',
                'pilihan_2' => 'Bekerja dalam sebuah tim untuk mencapai tujuan bersama.',
                'pilihan_3' => 'Mendapatkan pujian atau pengakuan atas pekerjaan saya.',
                'pilihan_4' => 'Memulai proyek atau ide baru yang kreatif.',
                'jawaban' => 2,
            ],
            [
                'id_kategori_soal' => $kategoriKepribadian->id_kategori_soal,
                'soal' => 'Lingkungan kerja yang paling saya sukai adalah...',
                'pilihan_1' => 'Lingkungan yang terstruktur dengan aturan yang jelas.',
                'pilihan_2' => 'Lingkungan yang fleksibel dan dinamis.',
                'pilihan_3' => 'Lingkungan yang kolaboratif dan suportif.',
                'pilihan_4' => 'Lingkungan yang kompetitif.',
                'jawaban' => 3,
            ],
            [
                'id_kategori_soal' => $kategoriKepribadian->id_kategori_soal,
                'soal' => 'Jika seorang teman curhat tentang masalahnya, saya akan...',
                'pilihan_1' => 'Memberikan solusi praktis untuk masalahnya.',
                'pilihan_2' => 'Mendengarkan dengan penuh empati.',
                'pilihan_3' => 'Mencoba mengalihkan perhatiannya dengan hal yang menyenangkan.',
                'pilihan_4' => 'Memberinya ruang untuk sendiri.',
                'jawaban' => 2,
            ],
            [
                'id_kategori_soal' => $kategoriKepribadian->id_kategori_soal,
                'soal' => 'Menurut saya, kegagalan adalah...',
                'pilihan_1' => 'Sesuatu yang harus dihindari dengan segala cara.',
                'pilihan_2' => 'Sebuah kesempatan untuk belajar dan tumbuh.',
                'pilihan_3' => 'Tanda bahwa saya tidak cukup baik.',
                'pilihan_4' => 'Hanya nasib buruk.',
                'jawaban' => 2,
            ],
            [
                'id_kategori_soal' => $kategoriKepribadian->id_kategori_soal,
                'soal' => 'Akhir pekan yang ideal bagi saya adalah...',
                'pilihan_1' => 'Dihabiskan bersama banyak teman dan aktivitas.',
                'pilihan_2' => 'Tenang di rumah dengan buku atau film.',
                'pilihan_3' => 'Melakukan petualangan spontan.',
                'pilihan_4' => 'Menyelesaikan pekerjaan atau proyek pribadi.',
                'jawaban' => 2,
            ],
            [
                'id_kategori_soal' => $kategoriKepribadian->id_kategori_soal,
                'soal' => 'Saya lebih suka pekerjaan yang...',
                'pilihan_1' => 'Memiliki rutinitas yang stabil dan dapat diprediksi.',
                'pilihan_2' => 'Menawarkan variasi dan tantangan baru setiap hari.',
                'pilihan_3' => 'Memberikan dampak positif bagi orang banyak.',
                'pilihan_4' => 'Memberikan potensi penghasilan tertinggi.',
                'jawaban' => 1,
            ],
            [
                'id_kategori_soal' => $kategoriKepribadian->id_kategori_soal,
                'soal' => 'Ketika menerima kritik, reaksi pertama saya adalah...',
                'pilihan_1' => 'Mempertahankannya dan menjelaskan alasan saya.',
                'pilihan_2' => 'Menerimanya dan merenungkan kebenarannya.',
                'pilihan_3' => 'Merasa sedikit tersinggung atau sedih.',
                'pilihan_4' => 'Mengabaikannya jika saya tidak setuju.',
                'jawaban' => 2,
            ],
        ];

        foreach ($soalList as $soal) {
            Soal::create([
                'id_kategori_soal' => $soal['id_kategori_soal'],
                'soal' => $soal['soal'],
                'pilihan_1' => $soal['pilihan_1'],
                'pilihan_2' => $soal['pilihan_2'],
                'pilihan_3' => $soal['pilihan_3'],
                'pilihan_4' => $soal['pilihan_4'],
                'jawaban' => $soal['jawaban'],
                'status' => true,
                'pembuat' => $pembuat,
                'type_soal' => 'text',
                'type_jawaban' => 'text',
            ]);
        }
    }
}