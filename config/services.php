<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    // Socialite
    'facebook' => [
        'client_id'     => '1823682094526376',
        'client_secret' => 'd2e07e70bb6d39ebbf4d28d5326ce557',
        'redirect'      => env('APP_URL', 'http://localhost') . '/auth/facebook/callback',
    ],
    'google' => [
        'client_id'     => '53674148852-ug4ut5o0e6uggrhv9scfa3u1q62us76n.apps.googleusercontent.com',
        'client_secret' => 'WQnDLmNKkqcMtSOvhiZl-pt3',
        'redirect'      => env('APP_URL', 'http://localhost') . '/auth/google/callback',
    ],

];
