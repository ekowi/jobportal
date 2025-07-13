<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    /** @use HasFactory<\Database\Factories\InterviewFactory> */
    use HasFactory;

    protected $fillable = [
        'progress_rekrutmen_id',
        'nama_sesi_interview',
        'status',
        'catatan',
        'dokumen_pendukung',
        'user_create',
    ];

    public function progressRekrutmen()
    {
        return $this->belongsTo(ProgressRekrutmen::class, 'progress_rekrutmen_id');
    }
}
