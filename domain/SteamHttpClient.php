<?php

namespace Domain;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class SteamHttpClient
{
    public function fetchAppList(): Collection
    {
        $response = Http::get(getSteamEndpoint('app_list'));
        return collect($response->json('applist.apps') ?? []);
    }

    public function fetchGameDetails(int $appid): ?array
    {
        $response = Http::get(getSteamEndpoint('game_details', ['appid' => $appid]));

        return $response->json()[$appid]['data'] ?? null;
    }

    public function fetchPlayersOnline(int $appid): ?int
    {
        $response = Http::get(getSteamEndpoint('players_online', ['appid' => $appid]));

        return $response->json('response.player_count') ?? null;
    }

    public function fetchGameNews(int $appid): array
    {
        $response = Http::get(getSteamEndpoint('game_news', ['appid' => $appid]));

        return $response->json('appnews.newsitems') ?? [];
    }

    public function fetchAchievements(int $appid): array
    {
        $response = Http::get(getSteamEndpoint('achievements', ['appid' => $appid]));

        return $response->json('achievementpercentages.achievements') ?? [];
    }
}
