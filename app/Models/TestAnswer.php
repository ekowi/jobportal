<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_result_id',
        'soal_id',
        'user_answer',
        'is_correct'
    ];

    protected $casts = [
        'is_correct' => 'boolean'
    ];

    public function testResult()
    {
        return $this->belongsTo(TestResult::class);
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'soal_id', 'id_soal');
    }
}