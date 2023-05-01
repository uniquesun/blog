<?php

namespace App\Request;

use JetBrains\PhpStorm\ArrayShape;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:12', 'unique:users,name'],
            'password' => ['required', 'max:16', 'min:6'],
            'email' => ['email', 'unique:users,email'],
            'phone' => ['unique:users,phone'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '请填写用户名',
            'name.min' => '用户名最短3个字符',
            'name.max' => '用户名最长12个字符',
            'name.unique' => '用户名已存在',

            'password.required' => '请填写密码',
            'password.max' => '密码最长16个字符',
            'password.min' => '密码最短6个字符',

            'email.email' => '邮箱格式不正确',
            'email.unique' => '邮箱已存在',

            'phone.unique' => '手机号已存在',

        ];
    }
}