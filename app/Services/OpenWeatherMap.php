<?php

namespace App\Services;

use App\Models\Interfaces\Weather;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Nette\Utils\Json;
use Nette\Utils\JsonException;

/**
 * Class OpenWeatherMap
 * https://openweathermap.org/current
 * @package App\Services
 */
class OpenWeatherMap implements Weather
{
    /**
     * Api address
     *
     * @var string
     */
    protected string $url = 'https://api.openweathermap.org/data/2.5/weather';

    /**
     * Api token
     *
     * @var string
     */
    protected string $token;

    /**
     * Geographical coordinates (latitude, longitude).
     * If you need the geocoder to automatic convert city names and zip-codes to geo coordinates and the other way around,
     * please use our Geocoding API https://openweathermap.org/api/geocoding-api.
     *
     * @var string
     */
    protected string $lat;
    protected string $lon;

    /**
     * By using this parameter you can exclude some parts of the weather data from the API response. It should be a comma-delimited list (without spaces).
     * Available values:
     *
     * - current
     * - minutely
     * - hourly
     * - daily
     * - alerts
     *
     * @var string
     */
    protected string $exclude = 'minutely,hourly,daily,alerts';

    /**
     * Units of measurement.
     * standard, metric and imperial units are available.
     * If you do not use the 'units' parameter, standard units will be applied by default.
     *
     * @var string
     */
    protected string $units = 'metric';

    /**
     * You can use the lang parameter to get the output in your language.
     *
     * @var string
     */
    protected string $lang = 'ru';

    /**
     * Api response as array.
     *
     * @var array
     */
    protected array $data = [];

    /**
     * Cache params.
     */
    protected const CACHE_TTL = 1 * 15 * 60;
    protected const CACHE_KEY_FORECAST = 'forecast';

    /**
     * {@inheritdoc}
     */
    public function __construct(string $lat, string $lon, string $token)
    {
        $this->lat = $lat;
        $this->lon = $lon;
        $this->token = $token;
    }

    /**
     * {@inheritdoc}
     */
    public function responseSuccess(): bool
    {
        return $this->data['cod'] ?? 0 === 200;
    }

    /**
     * {@inheritdoc}
     */
    public function getCityName(): string
    {
        return $this->data['name'];
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrentTemp(): int
    {
        return round($this->data['main']['temp']);
    }

    /**
     * {@inheritdoc}
     */
    public function getFeelslikeTemp(): int
    {
        return round($this->data['main']['feels_like']);
    }

    /**
     * {@inheritdoc}
     */
    public function getMaxTemp(): int
    {
        return round($this->data['main']['temp_max']);
    }

    /**
     * {@inheritdoc}
     */
    public function getMinTemp(): int
    {
        return round($this->data['main']['temp_min']);
    }

    /**
     * {@inheritdoc}
     */
    public function getWeatherDescription(): string
    {
        return $this->data['weather'][0]['description'];
    }

    /**
     * {@inheritdoc}
     */
    public function getIconUrl(): ?string
    {
        return 'http://openweathermap.org/img/wn/' . $this->data['weather'][0]['icon'] . '@2x.png';
    }

    /**
     * {@inheritdoc}
     */
    public function iconExist(): bool
    {
        return true;
    }

    /**
     * @return void
     * @throws JsonException
     */
    public function init(): void
    {
        $this->sendRequest();
        $this->setData();
    }

    /**
     * @return string
     */
    protected function sendRequest(): string
    {
        return Cache::remember(self::CACHE_KEY_FORECAST, self::CACHE_TTL, function () {
            $client = new Client();

            $response = $client->request('GET', $this->url, [
                'query' => [
                    'lat' => $this->lat,
                    'lon' => $this->lon,
                    'appid' => $this->token,
                    'exclude' => $this->exclude,
                    'units' => $this->units,
                    'lang' => $this->lang,
                ],
            ]);

            return $response->getBody()->getContents();
        });
    }

    /**
     * @return void
     * @throws JsonException
     */
    protected function setData(): void
    {
        $this->data = Json::decode($this->sendRequest(), Json::FORCE_ARRAY);
    }
}
