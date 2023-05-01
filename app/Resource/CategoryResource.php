<?php

namespace App\Resource;

use Hyperf\Resource\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'parent_id' => $this->parent_id,
            'is_directory' => $this->is_directory,
            'level' => $this->level,
            'path' => $this->path,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at
        ];
    }
}