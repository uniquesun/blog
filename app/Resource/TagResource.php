<?php

namespace App\Resource;

use Hyperf\Resource\Json\JsonResource;

class TagResource extends JsonResource
{
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}