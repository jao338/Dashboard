<?php

namespace Domain\Models\Tag\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this['name'],
            'icon' => $this['icon']
        ];
    }
}
