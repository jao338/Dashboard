<?php

namespace Domain\Models\Dashboard\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ColumnsChartResource extends JsonResource {

    public function toArray($request): array
    {
        return [
            'title'             => $this['title'],
            'current_players'   => $this['current_players'],
            'peak_players'      => $this['peak_players'],
        ];
    }
}
