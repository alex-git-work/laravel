<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Api id and key
    |--------------------------------------------------------------------------
    |
    | Number and key of your PushAll subscription.
    |
    */

    'id' => env('PUSHALL_ID', '0'),
    'key' => env('PUSHALL_KEY', 'key'),

    /*
    |--------------------------------------------------------------------------
    | Enables admin push notifications
    |--------------------------------------------------------------------------
    |
    | Sends additional admin push notifications when enabled.
    |
    */

    'enabled' => env('PUSHALL_ENABLED', false),
];
