<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    
    'facebook' => [
        'client_id' => '1110109336238635',
        'client_secret' => '57b9e249e875022f5ced689f3ead4804',
        'redirect' => 'http://localhost:8000/facebook/callback',
    ],

    'google' => [
        'client_id' => '284940690278-dnbeo87bkblt46g5bdm89db5sc3tobp8.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/google/callback',
    ],

];
