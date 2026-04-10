<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Sanctum Paths
    |--------------------------------------------------------------------------
    |
    | Here you may specify the routes through which users may access Sanctum's
    | token and ability management endpoints. These routes receive the Sanctum
    | middleware stack by default which helps to secure the endpoints against
    | any unauthorized access or threat to your application.
    |
    */

    'path_prefix' => env('SANCTUM_PATH_PREFIX', 'sanctum'),

    /*
    |--------------------------------------------------------------------------
    | Sanctum Statefull Domains
    |--------------------------------------------------------------------------
    |
    | Requests from the following domains / hosts will receive stateful Sanctum
    | cookies. Typically, these should include your local and production domains
    | which may be receiving API requests with stateful sessions.
    |
    */

    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
        '%s%s',
        'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1',
        env('APP_URL') ? ','.parse_url(env('APP_URL'), PHP_URL_HOST) : ''
    ))),

    /*
    |--------------------------------------------------------------------------
    | Sanctum Guard Configuration
    |--------------------------------------------------------------------------
    |
    | Laravel offers a variety of authentication guards that may be configured
    | here. Typically you may configure Sanctum to act as a stateful guard for
    | SPA authentication or as an API token guard for traditional API auth.
    |
    */

    'guard' => env('SANCTUM_GUARD', 'web'),

    /*
    |--------------------------------------------------------------------------
    | Sanctum Expiration Minutes
    |--------------------------------------------------------------------------
    |
    | Here you may specify how long (in minutes) you desire personal access
    | tokens to expire. This is useful for limiting the lifetime of tokens that
    | do not have an expiration time that is explicitly specified.
    |
    */

    'expiration' => 525600, // 1 year

    /*
    |--------------------------------------------------------------------------
    | Sanctum Middleware
    |--------------------------------------------------------------------------
    |
    | When authenticating your first-party SPAs, you should use the Sanctum
    | middleware stack instead of the default authentication middleware stack.
    | This middleware stack is optimized for SPA usage with features such as
    | CSRF protection and token rotation.
    |
    */

    'middleware' => [
        'authenticate_session' => Laravel\Sanctum\Http\Middleware\AuthenticateSession::class,
        'encrypt_cookies' => Illuminate\Cookie\Middleware\EncryptCookies::class,
        'validate_csrf_token' => Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
    ],

];
