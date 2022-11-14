<?php

namespace App\Providers;

use App\Services\PushAll;
use Illuminate\Support\ServiceProvider;

/**
 * Class PushAllServiceProvider
 * @package App\Providers
 */
class PushAllServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(PushAll::class, fn () => new PushAll());
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
