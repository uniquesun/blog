<?php

namespace App\Request;

class ArticleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'subtitle' => ['required'],
            'title' => ['required'],
            'content' => ['required'],
            'category' => ['array'],
            'tags' => ['array'],
            'image' => ['required', 'url']
        ];
    }

    public function messages(): array
    {
        return [
            'subtitle.required' => '小标题必填',
            'title.required' => '标题必填',
            'content.required' => '文章内容必填',
            'category.array' => '分类格式错误',
            'tags.array' => '标题格式错误',
            'image.required' => '图片必须',
            'image.url' => '图片格式错误'
        ];
    }

}