<?php

namespace App\Repository;

use App\Model\Article;

class ArticleRepository extends Repository
{
    protected $model;

    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function getAdminPaginate($data)
    {
        return $this->model
            ->with(['tags', 'categories'])
            ->selectWithoutContent()
            ->when($title = $data['title'], function ($query) use ($title) {
                $query->where('title', 'like', '%' . $title . '%');
            })
            ->when($data['order'] && $data['sort'], function ($query) use ($data) {
                $query->orderby($data['order'], $data['sort']);
            })
            ->paginate($data['page_size'], ['*'], 'page', $data['page']);
    }

    public function getWebPaginate($data)
    {
        return $this->model
            ->selectWithoutContent()
            ->published()
            ->when(($category_name = $data['category_name']), function ($query, $category_name) {
                $query->whereHas('categories', function ($query) use ($category_name) {
                    $query->where('name', $category_name);
                });
            })
            ->orderBy('id', 'desc')
            ->paginate($data['page_size'], ['*'], 'page', $data['page']);
    }

    public function findWithRelationship($slug): \Hyperf\Database\Model\Collection|\Hyperf\Database\Model\Model|array|\Hyperf\Database\Model\Builder|Article|null
    {
        if (is_string($slug)) {
            return $this->model::query(true)
                ->with(['tags', 'categories'])->where('slug', $slug)->first();
        }
        return $this->model::query(true)->with(['tags', 'categories'])->find($slug);
    }

    public function random($limit)
    {
        return $this->model
            ->selectWithoutContent()
            ->published()
            ->orderByRaw("RAND()")
            ->limit($limit)
            ->get();
    }

    public function recommend($limit)
    {
        return $this->model::query(true)
            ->selectWithoutContent()
            ->published()
            ->orderBy('is_recommend', 'desc')
            ->orderBy('id', 'asc')
            ->limit($limit)
            ->get();
    }

}