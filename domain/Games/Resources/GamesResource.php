<?php

namespace Domain\Games\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GamesResource extends JsonResource {

    public function toArray($request): array
    {
        return [
            'id'                  => $this['id'],
            'name'                => $this['name'],
            'number_of_players'   => $this['number_of_players'],
            'details'             => new GameDetailsResource($this['details'] ?? []),
        ];
    }
}
