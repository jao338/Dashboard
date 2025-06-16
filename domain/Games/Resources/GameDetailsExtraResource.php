<?php

namespace Domain\Games\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameDetailsExtraResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            => (string) $this['id'],
            'achievements'  => collect($this['achievements'])->map(fn ($item) => [
                'name'      => $item['name'],
                'percent'   => $item['percent'],
            ]),
            'news'          => collect($this['news'])->map(fn ($item) => [
                'gid'       => $item['gid'],
                'title'     => $item['title'],
                'url'       => $item['url'],
                'author'    => $item['author'],
                'contents'  => $item['contents'],
                'date'      => $item['date'],
                'appid'     => $item['appid'],
                'feedlabel' => $item['feedlabel'],
            ]),
        ];
    }
}
