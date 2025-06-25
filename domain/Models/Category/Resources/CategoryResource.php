<?php

namespace Domain\Models\Category\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this['name'],
            'icon' => $this['icon']
        ];
    }
}
