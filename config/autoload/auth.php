<?php

declare(strict_types=1);
/**
 * This file is part of hyperf-ext/auth.
 *
 * @link     https://github.com/hyperf-ext/auth
 * @contact  eric@zhu.email
 * @license  https://github.com/hyperf-ext/auth/blob/master/LICENSE
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'default' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    */

    'guards' => [
        'web' => [
            'driver' => \HyperfExt\Auth\Guards\SessionGuard::class,
            'provider' => 'users',
            'options' => [],
        ],

        'api' => [
            'driver' => \HyperfExt\Auth\Guards\JwtGuard::class,
            'provider' => 'users',
            'options' => [],
        ],

        'admin' => [
            'driver' => \HyperfExt\Auth\Guards\JwtGuard::class,
            'provider' => 'admin',
            'options' => [],
        ],
    ],

    'providers' => [

        'users' => [
            'driver' => \HyperfExt\Auth\UserProviders\ModelUserProvider::class,
            'options' => [
                'model' => App\Model\User::class,
                'hash_driver' => 'bcrypt',
            ],
        ],

        'api' => [
            'driver' => \HyperfExt\Auth\UserProviders\ModelUserProvider::class,
            'options' => [
                'model' => \App\Model\User::class,    // 用户模型
                'hash_driver' => 'bcrypt',
            ],
        ],

        'admin' => [
            'driver' => \HyperfExt\Auth\UserProviders\ModelUserProvider::class,
            'options' => [
                'model' =>\App\Model\AdminUser::class,
                'hash_driver' => 'bcrypt',
            ],
        ]

    ],


    'passwords' => [
        'users' => [
            'driver' => \HyperfExt\Auth\Passwords\DatabaseTokenRepository::class,
            'provider' => 'users',
            'options' => [
                'connection' => null,
                'table' => 'password_resets',
                'expire' => 3600,
                'throttle' => 60,
                'hash_driver' => null,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

    /*
    |--------------------------------------------------------------------------
    | Access Gate Policies
    |--------------------------------------------------------------------------
    |
    */

    'policies' => [
        //Model::class => Policy::class,
    ],
];
