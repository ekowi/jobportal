<?php

namespace App\Providers;

use App\Livewire\Forms\CustomInputErrors;
use App\Livewire\Forms\CustomValidationErrors;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // inpute components blade here
        Livewire::component('custom-validation-errors', CustomValidationErrors::class);
        Livewire::component('custom-input-error', CustomInputErrors::class);
    }
}
