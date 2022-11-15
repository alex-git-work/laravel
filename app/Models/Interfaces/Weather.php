<?php

namespace App\Models\Interfaces;

/**
 * Interface Weather
 * @package App\Models\Interfaces
 */
interface Weather
{
    /**
     * @param string $lat
     * @param string $lon
     * @param string $token
     */
    public function __construct(string $lat, string $lon, string $token);

    /**
     * Api response comes with code 200 (or something like that).
     *
     * @return bool
     */
    public function responseSuccess(): bool;

    /**
     * City name.
     *
     * @return string
     */
    public function getCityName(): string;

    /**
     * Temperature.
     * Current temperature.
     *
     * @return int
     */
    public function getCurrentTemp(): int;

    /**
     * Temperature.
     * This temperature parameter accounts for the human perception of weather.
     *
     * @return int
     */
    public function getFeelslikeTemp(): int;

    /**
     * Maximum temperature at the moment.
     * This is maximal currently observed temperature
     * (within large megalopolises and urban areas).
     *
     * @return int
     */
    public function getMaxTemp(): int;

    /**
     * Minimum temperature at the moment.
     * This is minimal currently observed temperature
     * (within large megalopolises and urban areas).
     *
     * @return int
     */
    public function getMinTemp(): int;

    /**
     * Weather condition within the group. Output in specified language.
     *
     * @return string
     */
    public function getWeatherDescription(): string;

    /**
     * Url for icon (optional).
     *
     * @return string|null
     */
    public function getIconUrl(): ?string;

    /**
     * Api got icons feature.
     *
     * @return bool
     */
    public function iconExist(): bool;
}
