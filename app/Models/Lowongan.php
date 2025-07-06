<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UserStampable;
use Illuminate\Database\Eloquent\Model;
// TODO: MEMBUATKAN CRUD UNTUK OFFICER LALU MEMBUAT CRUD UNTUK LOWONGAN SERTA TAMPILANNYA JANGAN LUPA UNTUK VALIDASI
class Lowongan extends Model
{
    /** @use HasFactory<\Database\Factories\LowonganFactory> */
    use HasFactory, UserStampable;

    protected $fillable = [
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
}
