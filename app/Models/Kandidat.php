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

    protected $table = 'kandidats';
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
        // 'bmi_score',
        // 'blind_score',
        'no_telpon_alternatif',
        'pengalaman_kerja',
        'pendidikan',
        'kemampuan_bahasa',
        'kemampuan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date:Y-m-d'
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
        return $this->belongsToMany(Lowongan::class, 'lamar_lowongans', 'kandidat_id', 'lowongan_id')
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

    /**
     * Relasi dengan hasil BMI Test
     * Satu kandidat memiliki satu hasil BMI Test
     */
    public function bmiTest()
    {
        return $this->hasOne(BmiTest::class);
    }

    /**
     * Relasi dengan hasil Blind Test
     * Satu kandidat memiliki satu hasil Blind Test
     */
    public function blindTest()
    {
        return $this->hasOne(BlindTest::class);
    }

    /**
     * Check apakah kandidat sudah menyelesaikan semua tes yang diperlukan
     * @return bool
     */
    public function hasCompletedAllTests()
    {
        return $this->bmiTest()->exists() && $this->blindTest()->exists();
    }

    /**
     * Check apakah kandidat sudah menyelesaikan BMI test
     * @return bool
     */
    public function hasCompletedBmiTest()
    {
        return $this->bmiTest()->exists();
    }

    /**
     * Check apakah kandidat sudah menyelesaikan Blind test
     * @return bool
     */
    public function hasCompletedBlindTest()
    {
        return $this->blindTest()->exists();
    }

    /**
     * Get BMI category dalam bahasa Indonesia
     * @return string|null
     */
    public function getBmiCategoryAttribute()
    {
        if (!$this->bmiTest) {
            return null;
        }
        return $this->bmiTest->kategori;
    }

    /**
     * Get Blind test percentage
     * @return int|null
     */
    public function getBlindTestPercentageAttribute()
    {
        if (!$this->blindTest) {
            return null;
        }
        return $this->blindTest->score;
    }
    public function lamarLowongans()
    {
        return $this->hasMany(LamarLowongan::class, 'kandidat_id');
    }
}