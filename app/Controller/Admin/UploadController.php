<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Middleware\Auth\RefreshTokenMiddleware;
use App\Service\File\FileContextService;
use App\Service\File\LocalUploaderService;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

#[Controller]
#[Middleware(RefreshTokenMiddleware::class)]
class UploadController extends AbstractController
{
    #[RequestMapping(path: '/admin/v1/image', methods: 'post')]
    public function image(FileContextService $fileContextService)
    {
        $image = $this->request->file('image');
        $allowed_ext = ['jpg', 'jpe', 'png', 'gif', 'bmp', 'tiff', 'ai', 'cdr', 'eps'];
        return $this->upload($image, $allowed_ext, $fileContextService);
    }

    #[RequestMapping(path: '/admin/v1/file', methods: 'post')]
    public function file(FileContextService $fileContextService)
    {
        $file = $this->request->file('file');
        $allowed_ext = ['jpg', 'jpe', 'png', 'gif', 'bmp', 'tiff', 'ai', 'cdr', 'eps'];
        return $this->upload($file, $allowed_ext, $fileContextService);
    }


    protected function upload($file, $allowed_ext, $fileContextService)
    {
        // 上传到本地
        $localUploader = new LocalUploaderService();
        $result = $fileContextService->setStrategy($localUploader)->upload($file, $allowed_ext);
        if ($result['status']) {
            return $this->data(['path' => $result['path']]);
        }
        return $this->failed($result['message']);
    }

}