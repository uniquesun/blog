<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Middleware\Auth\RefreshTokenMiddleware;
use App\Model\Tag;
use App\Resource\TagResource;
use App\Service\TagService;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

#[Controller]
#[Middleware(RefreshTokenMiddleware::class)]
class TagController extends AbstractController
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    #[RequestMapping(path: '/admin/v1/tag', methods: 'get')]
    public function index(RequestInterface $request)
    {
        $tags = $this->tagService->adminPaginate($request);
        return $this->resource(TagResource::collection($tags));
    }


    #[RequestMapping(path: '/admin/v1/tag/{id}', methods: 'delete')]
    public function destroy(int $id)
    {
        $this->tagService->destroy($id);
        return $this->success();
    }

}