<?php

namespace App\Repository;

class Repository
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function insert($data)
    {
        return $this->model::insert($data);
    }

    public function store($data)
    {
        return $this->model::create($data);
    }

    public function update($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        if (is_array($id)) {
            return $this->model::query()->whereIn('id', $id)->delete();
        }
        return $this->model::query()->where('id', $id)->delete();
    }
}