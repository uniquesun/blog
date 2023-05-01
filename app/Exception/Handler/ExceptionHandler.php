<?php

namespace App\Exception\Handler;


use App\Helper\ApiResponse;
use Hyperf\ExceptionHandler\ExceptionHandler as BaseExceptionHandler;
use Throwable;

abstract class ExceptionHandler extends BaseExceptionHandler
{
    use ApiResponse;

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}