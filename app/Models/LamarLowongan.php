<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LamarLowongan extends Model
{
    /** @use HasFactory<\Database\Factories\LamarLowonganFactory> */
    use HasFactory;

    protected $table = 'lamar_lowongans';
    protected $fillable = [
        'lowongan_id',
        'kandidat_id',
        'iklan_lowongan',
    ];

    // Relasi ke model Kandidat
    public function kandidat()
    {
        return $this->belongsTo(Kandidat::class);
    }

    // Relasi ke model Lowongan
    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }

    public function progressRekrutmen()
    {
        return $this->hasMany(ProgressRekrutmen::class, 'lamar_lowongan_id');
    }

}
