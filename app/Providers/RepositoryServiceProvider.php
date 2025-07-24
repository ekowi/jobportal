<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
        \App\Repositories\Interfaces\OfficerRepositoryInterface::class,
        \App\Repositories\OfficerRepository::class
        );
        $this->app->bind(
        \App\Repositories\Interfaces\KategoriLowonganRepositoryInterface::class,
        \App\Repositories\KategoriLowonganRepository::class
        );
        $this->app->bind(
            \App\Repositories\Interfaces\LowonganRepositoryInterface::class,
            \App\Repositories\LowonganRepository::class
        );
        $this->app->bind(
            \App\Repositories\Interfaces\ProgressRekrutmenRepositoryInterface::class,
            \App\Repositories\ProgressRekrutmenRepository::class
        );
        $this->app->bind(
            \App\Repositories\Interfaces\KandidatRepositoryInterface::class,
            \App\Repositories\KandidatRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
