<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressRekrutmen extends Model
{
    /** @use HasFactory<\Database\Factories\ProgressRekrutmenFactory> */
    use HasFactory;

    protected $fillable = [
        'lamar_lowongan_id',
        'officer_id',
        'nama_progress',
        'status',
        'catatan',
        'dokumen_pendukung',
        'is_interview',
        'is_psikotes',
        'waktu_pelaksanaan',
        'user_create',
    ];

    protected $casts = [
        'waktu_pelaksanaan' => 'datetime',
        'is_interview' => 'boolean',
        'is_psikotes' => 'boolean',
    ];

    public function lamarlowongan()
    {
        return $this->belongsTo(Lamarlowongan::class, 'lamar_lowongan_id');
    }

    // Relasi dengan User (Officer)
    public function officer()
    {
        return $this->belongsTo(Officer::class, 'officer_id');
    }

    public function interview()
    {
        return $this->hasOne(Interview::class, 'progress_rekrutmen_id');
    }
}
