<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Middleware\Auth\RefreshTokenMiddleware;
use App\Model\AdminUser;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use HyperfExt\Hashing\Hash;

#[Controller]
class AdminUserController extends AbstractController
{

    #[RequestMapping(path: '/admin/v1/me', methods: 'get')]
    #[Middleware(RefreshTokenMiddleware::class)]
    public function me(RequestInterface $request)
    {
        $user = auth('admin')->user();
        return $this->data($user);
    }

    #[RequestMapping(path: '/admin/v1/me', methods: 'put')]
    #[Middleware(RefreshTokenMiddleware::class)]
    public function update(RequestInterface $request)
    {
        $user = auth('admin')->user();
        $data = [];
        if ($password = $request->input('password')) {
            $data['password'] = Hash::make($password);
        }
        if ($avatar = $request->input('avatar')) {
            $data['avatar'] = $avatar;
        }
        AdminUser::query()->where('id', $user->id)->update($data);
        return $this->success();
    }

}