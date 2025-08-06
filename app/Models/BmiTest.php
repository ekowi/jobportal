<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BmiTest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kandidat_id',
        'tinggi_badan',
        'berat_badan',
        'score',
        'kategori',
    ];

    /**
     * Mendefinisikan relasi ke Kandidat.
     */
    public function kandidat()
    {
        return $this->belongsTo(Kandidat::class);
    }
}