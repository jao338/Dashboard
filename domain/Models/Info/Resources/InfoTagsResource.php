<?php

namespace Domain\Models\Info\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InfoTagsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'tag' => $this['tag'],
        ];
    }
}
