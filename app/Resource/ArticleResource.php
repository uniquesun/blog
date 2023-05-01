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
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'tags' => TagResource::collection($this->whenLoaded('tags'))
        ];
    }
}