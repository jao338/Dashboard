<?php

namespace Domain\Models\Info\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InfoGamesResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'game' => $this['game'],
        ];
    }
}
