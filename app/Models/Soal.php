<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UserStampable;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soals';
    protected $primaryKey = 'id_soal';

    protected $fillable = [
        'id_kategori_soal',
        'type_soal_id',
        'type_jawaban_id',
        'soal',
        'pilihan_1',
        'pilihan_2',
        'pilihan_3',
        'pilihan_4',
        'jawaban',
        'status',
        'pembuat',
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriSoal::class, 'id_kategori_soal', 'id_kategori_soal');
    }

     public function creator()
    {
        return $this->belongsTo(User::class, 'user_create', 'id');
    }

    public function typeSoal()
    {
        return $this->belongsTo(Type::class, 'type_soal_id');
    }

    public function typeJawaban()
    {
        return $this->belongsTo(Type::class, 'type_jawaban_id');
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