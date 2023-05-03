<?php

namespace App\Repository;

use App\Model\Tag;

class TagRepository extends Repository
{
    protected $model;

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    public function findExistName($name)
    {
        return $this->model->whereIn('name', $name)->get();
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

}