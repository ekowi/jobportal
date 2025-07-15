<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UserStampable;
use Illuminate\Database\Eloquent\Model;
class Lowongan extends Model
{
    /** @use HasFactory<\Database\Factories\LowonganFactory> */
    use HasFactory, UserStampable;

    protected $fillable = [
        'kategori_lowongan_id',
        'status',
        'nama_posisi',
        'departemen',
        'lokasi_penugasan',
        'is_remote',
        'tanggal_posting',
        'tanggal_berakhir',
        'foto',
        'deskripsi',
        'range_gaji',
        'kemampuan_yang_dibutuhkan',
        'is_aktif',
        'kategori_lowongan_id',
        'user_create',
        'user_update',
    ];

    protected $casts = [
        'tanggal_posting' => 'date',
        'tanggal_berakhir' => 'date',
        'is_remote' => 'boolean',
        'is_aktif' => 'boolean',
    ];

    /**
     * Relasi antara Lowongan dan KategoriLowongan.
     * Setiap lowongan terkait dengan satu kategori lowongan.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<KategoriLowongan, Lowongan>
     */
    public function kategoriLowongan()
    {
        return $this->belongsTo(KategoriLowongan::class, 'kategori_lowongan_id');
    }

    public function kandidats()
    {
        return $this->belongsToMany(Kandidat::class, 'lamarlowongan', 'lowongan_id', 'kandidat_id')
                    ->withPivot('iklan_lowongan') // Menyertakan data pivot
                    ->withTimestamps(); // Menyertakan timestamps jika diperlukan
    }

    public function getFormattedGajiAttribute()
    {
        if (strpos($this->range_gaji, '-') !== false) {
            $ranges = explode('-', $this->range_gaji);
            $minSalary = (int)$ranges[0] * 1000; // Konversi ke ribuan
            $maxSalary = (int)$ranges[1] * 1000;
            return 'Rp ' . number_format($minSalary, 0, ',', '.') . ' - Rp ' . number_format($maxSalary, 0, ',', '.');
        }

        return 'Rp ' . number_format((int)$this->range_gaji * 1000, 0, ',', '.');
    }
}
