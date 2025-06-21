<?php

namespace Domain\Models\Genre\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GenreResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'icon' => $this->icon
        ];
    }
}
