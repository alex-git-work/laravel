<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default coordinates
    |--------------------------------------------------------------------------
    |
    | Geographical coordinates (latitude, longitude).
    | Defaults are for the Moscow.
    |
    */

    'defaults' => [
        'lat' => '55.755864',
        'lon' => '37.61769',
    ],

    /*
    |--------------------------------------------------------------------------
    | API key
    |--------------------------------------------------------------------------
    |
    | Your unique API key.
    | You can always find it on your account page under the "API key" tab.
    | https://home.openweathermap.org/api_keys
    |
    */

    'token' => env('OPENWEATHERMAP_KEY', 'key'),
];
