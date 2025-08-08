<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['nama'];

    public function soalsWithQuestionType()
    {
        return $this->hasMany(Soal::class, 'type_soal_id');
    }

    public function soalsWithAnswerType()
    {
        return $this->hasMany(Soal::class, 'type_jawaban_id');
    }
}