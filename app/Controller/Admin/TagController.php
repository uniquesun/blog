<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Middleware\Auth\RefreshTokenMiddleware;
use App\Model\Tag;
use App\Resource\TagResource;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

#[Controller]
#[Middleware(RefreshTokenMiddleware::class)]
class TagController extends AbstractController
{

    #[RequestMapping(path: '/admin/v1/tag', methods: 'get')]
    public function index(RequestInterface $request)
    {
        $page = $request->input('page', 1);
        $page_size = $request->input('page_size', 20);
        $name = $request->input('name');
        $order = $request->input('order');
        $sort = $request->input('sort');

        $categories = Tag::query()
            ->when($name, function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            })
            ->when($order & $sort, function ($query) use ($order, $sort) {
                $query->orderby($order, $sort);
            })
            ->paginate($page_size, ['*'], 'page', $page);

        return $this->resource(TagResource::collection($categories));
    }


    #[RequestMapping(path: '/admin/v1/tag/{id}', methods: 'delete')]
    public function destroy(int $id)
    {
        Tag::query()->where('id', $id)->delete();
        return $this->success();
    }

}