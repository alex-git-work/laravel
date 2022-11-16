<?php

namespace App\Providers;

use App\Services\PushAll;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Class PushAllServiceProvider
 * @package App\Providers
 */
class PushAllServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(PushAll::class, function () {
            return new PushAll(config('pushall.id'), config('pushall.key'));
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

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [PushAll::class];
    }
}
