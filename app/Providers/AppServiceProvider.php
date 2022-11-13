<?php

namespace App\Providers;

use App\Models\Tag;
use App\Services\OpenWeatherMap;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        view()->composer('layout.sidebar', fn (View $view) => $view->with(['cloud' => Tag::cloud(), 'forecast' => $this->app->get(OpenWeatherMap::class)]));

        Blade::if('admin', fn () => optional(auth()->user())->isAdmin());
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
