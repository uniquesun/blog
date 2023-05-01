<?php

namespace App\Service\File;

use Hyperf\Utils\Str;

class LocalUploaderService implements UploaderInterface
{
    public function upload(...$arguments)
    {
        $file = $arguments[0];
        $allowed_ext = $arguments[1] ?? [];

        $folder_name = "uploads/";
        $upload_path = BASE_PATH . '/public/' . $folder_name;
        $extension = strtolower($file->getExtension()) ?: 'png';
        $filename = time() . '_' . Str::random(10) . '.' . $extension;

        if ($allowed_ext && !in_array($extension, $allowed_ext)) {
            return ['status' => false, 'message' => '文件类型错误'];
        }
        // 上传
        $file->moveTo($upload_path . '/' . $filename);
        return [
            'status' => true,
            'path' => config('app_url') . "/$folder_name/$filename"
        ];

    }
}