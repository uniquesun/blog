<?php


if (!function_exists('auth')) {
    function auth(string $guard = 'api')
    {
        if (is_null($guard)) $guard = config('auth.default.guard');
        return make(\HyperfExt\Auth\Contracts\AuthManagerInterface::class)->guard($guard);
    }
}