<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UserStampable;
use Illuminate\Database\Eloquent\Model;

class KategoriLowongan extends Model
{
    /** @use HasFactory<\Database\Factories\KategoriLowonganFactory> */
    use HasFactory, UserStampable;

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'user_create',
        'user_update',
    ];
    
}
