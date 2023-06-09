<?php

namespace App\Resource;

use Hyperf\Resource\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'subtitle' => $this->subtitle,
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            'content' => $this->content,
            'is_recommend' => (boolean)$this->is_recommend,
            'is_published' => (boolean)$this->is_published,
            'created_at' => substr((string)$this->created_at, 0, 10),
            'updated_at' => substr((string)$this->updated_at,0,10),
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'tags' => TagResource::collection($this->whenLoaded('tags'))
        ];
    }
}