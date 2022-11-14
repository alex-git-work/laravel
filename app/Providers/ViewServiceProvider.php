<?php

namespace App\Providers;

use App\Models\Tag;
use App\Services\OpenWeatherMap;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Request;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        view()->composer('layout.sidebar', fn (View $view) => $view->with(['cloud' => Tag::cloud()]));

        if (Request::getRequestUri() === RouteServiceProvider::HOME) {
            view()->composer('layout.sidebar', fn (View $view) => $view->with(['forecast' => $this->app->get(OpenWeatherMap::class)]));
        }
    }
}
