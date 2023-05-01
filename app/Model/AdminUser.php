<?php

namespace App\Model;

use HyperfExt\Auth\Authenticatable;
use HyperfExt\Auth\Contracts\AuthenticatableInterface;
use HyperfExt\Jwt\Contracts\JwtSubjectInterface;

class AdminUser extends Model implements AuthenticatableInterface, JwtSubjectInterface
{
    use Authenticatable;

    protected $table = 'admin_users';

    protected $guarded = [];

    protected $hidden = ['password'];


    public function getJwtIdentifier()
    {
        return $this->getKey();
    }

    public function getJwtCustomClaims(): array
    {
        return [
            'guard' => 'admin'    // 添加一个自定义载荷保存守护名称，方便后续判断
        ];
    }

}