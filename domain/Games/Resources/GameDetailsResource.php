<?php

namespace Domain\Games\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameDetailsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type'                => $this['type'],
            'steam_appid'         => $this['steam_appid'],
            'required_age'        => $this['required_age'],
            'is_free'             => $this['is_free'],
            'short_description'   => $this['short_description'],
            'header_image'        => $this['header_image'],
            'website'             => $this['website'],
            'developers'          => $this['developers'],
            'publishers'          => $this['publishers'],
            'price'               => $this['price_overview']['final_formatted'],
            'platforms'           => $this['platforms'],
            'categories'          => collect($this['categories'] ?? [])->pluck('description'),
            'genres'              => collect($this['genres'] ?? [])->pluck('description'),
//            'metacritic_score'    => $this['metacritic']['score'],
            'release_date'        => $this['release_date']['date'],
            'screenshots'         => collect($this['screenshots'] ?? [])->pluck('path_full'),
            'ratings'             => $this['ratings'],
        ];
    }
}
