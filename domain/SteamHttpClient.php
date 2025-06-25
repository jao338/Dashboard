<?php

namespace Domain;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class SteamHttpClient
{

    public function __construct() {
        ini_set('memory_limit', '512M');
    }

    public function fetchAppList(int $limit = 5): Collection
    {
        $response = Http::get(getSteamEndpoint('app_list'));
        $apps = collect($response->json('applist.apps') ?? []);

        return $apps->filter(fn($app) => !empty($app['name']))->take($limit);
    }

    public function fetchGameDetails(int $appid): ?array
    {
        try {
            $response = Http::get(getSteamEndpoint('game_details', ['appid' => $appid]));
            return $response->json()[$appid]['data'] ?? null;
        } catch (\Throwable $e) {
            logger()->warning("Erro ao buscar detalhes do jogo $appid", ['exception' => $e]);
            return null;
        }
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
