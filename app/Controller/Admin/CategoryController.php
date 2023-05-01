<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Middleware\Auth\RefreshTokenMiddleware;
use App\Model\Category;
use App\Request\CategoryRequest;
use App\Resource\CategoryResource;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

#[Controller]
#[Middleware(RefreshTokenMiddleware::class)]
class CategoryController extends AbstractController
{

    #[RequestMapping(path: '/admin/v1/category', methods: 'get')]
    public function index(RequestInterface $request)
    {
        $page = $request->input('page', 1);
        $page_size = $request->input('page_size', 20);
        $name = $request->input('name');
        $order = $request->input('order');
        $sort = $request->input('sort');

        $categories = Category::query()
            ->when($name, function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            })
            ->when($order & $sort, function ($query) use ($order, $sort) {
                $query->orderby($order, $sort);
            })
            ->paginate($page_size, ['*'], 'page', $page);

        return $this->resource(CategoryResource::collection($categories));
    }

    #[RequestMapping(path: '/admin/v1/category', methods: 'post')]
    public function store(CategoryRequest $request)
    {
        Category::create([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id', 0),
            'image' => $request->input('image', null)
        ]);
        return $this->success();
    }

    #[RequestMapping(path: '/admin/v1/category/{id}', methods: 'put')]
    public function update(int $id, RequestInterface $request)
    {
        $category = Category::query()->find($id);
        if (!$category) return $this->notFound();

        if ($name = $request->input('name')) $category->name = $name;
        if ($image = $request->input('image')) $category->image = $image;
        $parent_id = $request->input('parent_id');
        if (!is_null($parent_id)) $category->parent_id = $parent_id;
        $category->save();

        return $this->success();
    }

    #[RequestMapping(path: '/admin/v1/category/{id}', methods: 'delete')]
    public function destroy(int $id)
    {
        Category::query()->where('id', $id)->delete();
        return $this->success();
    }

}