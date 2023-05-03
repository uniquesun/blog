<?php

namespace App\Repository;

use App\Model\Category;

class CategoryRepository extends Repository
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getAdminPaginate($data)
    {
        return $this->model::query()
            ->when($name = $data['name'], function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            })
            ->when(($order = $data['order']) && ($sort = $data['sort']), function ($query) use ($order, $sort) {
                $query->orderby($order, $sort);
            })
            ->paginate($data['page_size'], ['*'], 'page', $data['page']);
    }

    public function all()
    {
        return $this->model::query(true)->orderBy('level')->orderBy('id')->get();
    }
}