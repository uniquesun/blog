<?php

namespace App\Request;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:categories,name'],
            'parent_id' => ['integer']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '分类名必填',
            'name.unique' => '分类已存在',
            'parent_id.integer' => '父分类格式错误'
        ];
    }

}