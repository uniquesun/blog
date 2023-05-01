<?php

namespace App\Controller\Api;

use App\Controller\AbstractController;
use App\Middleware\Auth\RefreshTokenMiddleware;
use App\Model\User;
use App\Request\UserRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Contract\RequestInterface;
use HyperfExt\Hashing\Hash;
use HyperfExt\Jwt\Contracts\JwtFactoryInterface;



#[Controller]
class AuthController extends AbstractController
{
    #[RequestMapping(path: '/api/v1/register', methods: 'post')]
    public function register(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
            'email' => $request->input('email', null),
            'phone' => $request->input('phone', null),
        ]);
        $token = auth()->login($user);
        return $this->respondWithToken($token);
    }

    #[RequestMapping(path: '/api/v1/login', methods: 'post')]
    public function login(RequestInterface $request)
    {
        $credentials = $request->inputs(['name', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return $this->failed('登录失败，账号密码错误');
        }
        return $this->respondWithToken($token);
    }

    #[RequestMapping(path: '/api/v1/logout', methods: 'delete')]
    #[Middleware(RefreshTokenMiddleware::class)]
    public function logout()
    {
        auth()->logout();
        return $this->success('退出成功~');
    }

    #[RequestMapping(path: '/api/v1/tokenRefresh', methods: 'put')]
    #[Middleware(RefreshTokenMiddleware::class)]
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    protected function respondWithToken($token): \Psr\Http\Message\ResponseInterface
    {
        return $this->data([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expire_in' => make(JwtFactoryInterface::class)->make()->getPayloadFactory()->getTtl()
        ]);
    }

}