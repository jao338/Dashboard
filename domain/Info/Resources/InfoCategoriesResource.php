<?php

namespace Domain\Info\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InfoCategoriesResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'category' => $this['category'],
        ];
    }
}
