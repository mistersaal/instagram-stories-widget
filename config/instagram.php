<?php

return [

    'auth' => [
        'userAgent' => env('INSTAGRAM_USERAGENT', 'Mozilla/5.0'),
        'login' => env('INSTAGRAM_LOGIN', 'login'),
        'password' => env('INSTAGRAM_PASSWORD', 'password'),
    ],

    'baseUrl' => 'https://www.instagram.com',
    'encryptionKeyUrl' => '/data/shared_data/',

    'highlights' => [
        'url' => '/stories/highlights/'
    ],

    'cacheMinutes' => 10,

    'api' => [
        'app_id' => env('INSTAGRAM_APP_ID'),
        'app_secret' => env('INSTAGRAM_APP_SECRET'),
        'default_graph_version' => env('INSTAGRAM_API_VERSION')
    ]
];
