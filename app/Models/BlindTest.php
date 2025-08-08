<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlindTest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kandidat_id',
        'total_questions',
        'correct_answers',
        'score',
        'details',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'details' => 'array', // Agar kolom details otomatis di-handle sebagai array/JSON
        'score' => 'integer',
        'total_questions' => 'integer',
        'correct_answers' => 'integer',
    ];

    /**
     * Mendefinisikan relasi ke Kandidat.
     */
    public function kandidat()
    {
        return $this->belongsTo(Kandidat::class);
    }

    /**
     * Get percentage as formatted string
     * @return string
     */
    public function getFormattedScoreAttribute()
    {
        return $this->score . '%';
    }

    /**
     * Get test result status
     * @return string
     */
    public function getStatusAttribute()
    {
        if ($this->score >= 80) {
            return 'Excellent';
        } elseif ($this->score >= 60) {
            return 'Good';
        } elseif ($this->score >= 40) {
            return 'Fair';
        } else {
            return 'Poor';
        }
    }

    /**
     * Get wrong answers count
     * @return int
     */
    public function getWrongAnswersAttribute()
    {
        return $this->total_questions - $this->correct_answers;
    }
}