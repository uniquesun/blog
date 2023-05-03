<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Middleware\Auth\RefreshTokenMiddleware;
use App\Model\Category;
use App\Request\CategoryRequest;
use App\Resource\CategoryResource;
use App\Service\CategoryService;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

#[Controller]
#[Middleware(RefreshTokenMiddleware::class)]
class CategoryController extends AbstractController
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    #[RequestMapping(path: '/admin/v1/category', methods: 'get')]
    public function index(RequestInterface $request)
    {
        $categories = $this->categoryService->adminPaginate($request);
        return $this->resource(CategoryResource::collection($categories));
    }

    #[RequestMapping(path: '/admin/v1/category', methods: 'post')]
    public function store(CategoryRequest $request)
    {
        $this->categoryService->store($request);
        return $this->success();
    }

    #[RequestMapping(path: '/admin/v1/category/{id}', methods: 'put')]
    public function update(int $id, RequestInterface $request)
    {
        if (!$category = Category::query()->find($id)) return $this->notFound();
        $this->categoryService->update($category, $request);
        return $this->success();
    }

    #[RequestMapping(path: '/admin/v1/category/{id}', methods: 'delete')]
    public function destroy(int $id)
    {
        $this->categoryService->destroy($id);
        return $this->success();
    }

}