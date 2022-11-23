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
        $this->app->singleton(OpenWeatherMap::class, function () {
            return new OpenWeatherMap(
                config('openweather.defaults.lat'),
                config('openweather.defaults.lon'),
                config('openweather.token')
            );
        });
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
