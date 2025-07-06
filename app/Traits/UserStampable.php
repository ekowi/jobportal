<?php

namespace App\Traits;
use Illuminate\Support\Facades\Auth;

/**
 * Trait UserStampable
 *
 * digunakan untuk menambahkan informasi pengguna yang membuat atau memperbarui model.
 * Ini akan secara otomatis mengisi kolom `user_create` dan `user_update` pada
 */
trait UserStampable
{
    public static function bootUserStampable()
    {
        // Set user_create saat membuat record baru
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->user_create = Auth::id();
            }
        });

        // Set user_update saat memperbarui record
        static::updating(function ($model) {
            if (Auth::check()) {
                $model->user_update = Auth::id();
            }
        });
    }
}
