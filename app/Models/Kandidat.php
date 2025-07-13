<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UserStampable;
use Illuminate\Database\Eloquent\Model;

/**
 * Model perwakilan kandidat dalam sistem.
 * berisi informasi pribadi, kontak, dan kualifikasi kandidat.
 * Kandidat dapat memiliki banyak pengalaman kerja, pendidikan, dan kemampuan.
 * @author zen-master <greget103@gmail.com>
 */
class Kandidat extends Model
{
    /** @use HasFactory<\Database\Factories\KandidatFactory> */
    use HasFactory, UserStampable;

    protected $fillable = [
        'user_id',
        'nama_depan',
        'nama_belakang',
        'no_telpon',
        'alamat',
        'kode_pos',
        'negara',
        'no_ktp',
        'no_npwp',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'status_perkawinan',
        'agama',
        'bmi_score',
        'blind_score',
        'no_telpon_alternatif',
        'pengalaman_kerja',
        'pendidikan',
        'kemampuan_bahasa',
        'kemampuan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];

    /**
     * Mengembalikan relasi kandidat dengan pengguna.
     * Relasi ini menunjukkan bahwa setiap kandidat terkait dengan satu pengguna.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Kandidat>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lowongans()
    {
        return $this->belongsToMany(Lowongan::class, 'lamarlowongan', 'kandidat_id', 'lowongan_id')
                    ->withPivot('iklan_lowongan') // Menyertakan data pivot
                    ->withTimestamps(); // Menyertakan timestamps jika diperlukan
    }

    /**
     * Mengambil nama lengkap kandidat.
     * Menggabungkan nama depan dan nama belakang menjadi satu string.
     * Jika nama belakang tidak ada, hanya nama depan yang dikembalikan.
     * @return string
     */
    public function getFullNameAttribute()
    {
        return trim("{$this->nama_depan} {$this->nama_belakang}");
    }

    /**
     * Mengambil alamat lengkap kandidat.
     * Menggabungkan alamat, kode pos, dan negara menjadi satu string.
     * @return string
     */
    public function getFormattedAddressAttribute()
    {
        return trim("{$this->alamat}, {$this->kode_pos}, {$this->negara}");
    }

}
