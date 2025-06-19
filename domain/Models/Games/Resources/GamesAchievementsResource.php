<?php

namespace Domain\Models\Games\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GamesAchievementsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name'            => $this['name'],
            'percent'         => $this['percent'],
        ];
    }
}
