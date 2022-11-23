<?php

namespace App\Facades;

use App\Services\OpenWeatherMap;
use Illuminate\Support\Facades\Facade;

/**
 * Class OpenWeather
 *
 * @method static bool responseSuccess()
 * @method static string getCityName()
 * @method static int getCurrentTemp()
 * @method static int getFeelslikeTemp()
 * @method static int getMaxTemp()
 * @method static int getMinTemp()
 * @method static string getWeatherDescription()
 * @method static string|null getIconUrl()
 * @method static bool iconExist()
 *
 * @package App\Facades
 */
class OpenWeather extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor(): string
    {
        return OpenWeatherMap::class;
    }
}
