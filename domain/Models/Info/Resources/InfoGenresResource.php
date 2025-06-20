<?php

namespace Domain\Models\Info\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InfoGenresResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this['name'],
        ];
    }
}
