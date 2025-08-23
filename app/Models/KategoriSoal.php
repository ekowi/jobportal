<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSoal extends Model
{
    use HasFactory;

    protected $table = 'kategori_soals';
    protected $primaryKey = 'id_kategori_soal';
    
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function soals()
    {
        return $this->hasMany(Soal::class, 'id_kategori_soal', 'id_kategori_soal');
    }
}