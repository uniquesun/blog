<?php

namespace App\Exception\Handler;

// 异常处理器
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ValidationExceptionHandler extends ExceptionHandler
{

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        if ($throwable instanceof ValidationException) {
            $this->stopPropagation();
            $error = $throwable->validator->errors()->first();
            return $this->failed($error);
        }
        return $response;
    }


}