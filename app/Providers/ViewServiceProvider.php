<?php

namespace App\Providers;

use App\Models\Tag;
use App\Services\OpenWeatherMap;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

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

        view()->composer('layout.weather', function (View $view) {
            /** @var OpenWeatherMap $forecast */
            $forecast = $this->app->make(OpenWeatherMap::class);

            $forecast->init();

            return $view->with([
                'showWeather' => $forecast->responseSuccess(),
                'cityName' => $forecast->getCityName(),
                'currentTemp' => $forecast->getCurrentTemp(),
                'feelslikeTemp' => $forecast->getFeelslikeTemp(),
                'maxTemp' => $forecast->getMaxTemp(),
                'minTemp' => $forecast->getMinTemp(),
                'weatherDescription' => $forecast->getWeatherDescription(),
                'iconExist' => $forecast->iconExist(),
                'iconUrl' => $forecast->getIconUrl(),
            ]);
        });
    }
}
