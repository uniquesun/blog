<?php

namespace App\Resource;

use App\Constants\UserStatus;
use Hyperf\Resource\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => UserStatus::getMessage($this->status),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
