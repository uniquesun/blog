<?php

namespace App\Controller\Api;

use App\Controller\AbstractController;
use App\Middleware\Auth\RefreshTokenMiddleware;
use App\Model\User;
use App\Resource\UserResource;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Contract\RequestInterface;


#[Controller]
class UserController extends AbstractController
{

    #[RequestMapping(path: '/api/v1/me', methods: 'get')]
    #[Middleware(RefreshTokenMiddleware::class)]
    public function me(RequestInterface $request)
    {
        $user = auth('api')->user();
        return $this->data($user);
    }
}