<?php

namespace Domain\Models\Auth\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'email' => $this['email'],
            'token' => $this->getActionToken(),
        ];
    }
}
