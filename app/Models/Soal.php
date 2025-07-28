<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soals';
    protected $primaryKey = 'id_soal';

    protected $fillable = [
        'id_kategori_soal',
        'soal',
        'pilihan_1',
        'pilihan_2',
        'pilihan_3',
        'pilihan_4',
        'id_kategori_jawaban',
        'jawaban',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriSoal::class, 'id_kategori_soal', 'id_kategori_soal');
    }

    public function getJawabanBenarTextAttribute()
    {
        switch ($this->jawaban) {
            case 1:
                return $this->pilihan_1;
            case 2:
                return $this->pilihan_2;
            case 3:
                return $this->pilihan_3;
            case 4:
                return $this->pilihan_4;
            default:
                return 'Tidak ada jawaban';
        }
    }
}