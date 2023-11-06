<?php

namespace App\Providers;

use App\Services\Ravelry\RavelryApiService;
use Illuminate\Support\ServiceProvider;

class RavelryApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(RavelryApiService::class, function ($app) {
            return new RavelryApiService(
                config('services.ravelry.username'),
                config('services.ravelry.password'),
                'https://api.ravelry.com/',
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
