<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $fillable = [
        'user_id',
        'total_questions',
        'correct_answers',
        'score',
        'answers_data',
        'started_at',
        'completed_at'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'answers_data' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}