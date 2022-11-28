<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application pagination
    |--------------------------------------------------------------------------
    |
    | You may specify how many models to retrieve per page on each section.
    |
    */

    'public_section' => [
        'articles' => 10,
        'news' => 10,
    ],

    'admin_section' => [
        'articles' => 20,
        'news' => 20,
        'each_side' => 2,
    ],
];
