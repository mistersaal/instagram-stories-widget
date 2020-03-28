<?php

return [

    'auth' => [
        'userAgent' => env('INSTAGRAM_USERAGENT', 'Mozilla/5.0'),
        'login' => env('INSTAGRAM_LOGIN', 'login'),
        'password' => env('INSTAGRAM_PASSWORD', 'password'),
    ],

    'baseUrl' => 'https://www.instagram.com',
    'encryptionKeyUrl' => '/data/shared_data/',

];
