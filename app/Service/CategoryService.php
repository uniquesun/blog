<?php

namespace App\Service;

use App\Model\Category;
use App\Repository\CategoryRepository;
use Hyperf\HttpServer\Contract\RequestInterface;

class CategoryService
{
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function adminPaginate(RequestInterface $request)
    {
        $page = $request->input('page', 1);
        $page_size = $request->input('page_size', 20);
        $name = $request->input('name');
        $order = $request->input('order');
        $sort = $request->input('sort');

        return $this->categoryRepository->getAdminPaginate(compact(
            'page', 'page_size', 'name', 'order', 'sort',
        ));

    }

    public function update($category, RequestInterface $request)
    {
        return $this->categoryRepository->update($category->id, [
            'name' => $request->input('name', $category->name),
            'parent_id' => $request->input('parent_id', $category->parent_id),
            'image' => $request->input('image', $category->image),
            'is_recommend' => $request->input('is_recommend', $category->is_recommend)
        ]);
    }

    public function store(RequestInterface $request)
    {
        return $this->categoryRepository->store([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id', 0),
            'image' => $request->input('image', null),
            'is_recommend' => $request->input('is_recommend', false)
        ]);
    }

    public function destroy($id)
    {
        return $this->categoryRepository->destroy($id);
    }

    public function all()
    {
        return $this->categoryRepository->all();
    }

}