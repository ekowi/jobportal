<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\OfficerRepositoryInterface;
use App\Repositories\OfficerRepository;

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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
