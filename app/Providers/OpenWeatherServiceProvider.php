<?php

namespace App\Providers;

use App\Services\OpenWeatherMap;
use Illuminate\Support\ServiceProvider;

/**
 * Class OpenWeatherServiceProvider
 * @package App\Providers
 */
class OpenWeatherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(OpenWeatherMap::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
