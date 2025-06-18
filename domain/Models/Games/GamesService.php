<?php

namespace Domain\Models\Games;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class GamesService
{
    public function globalAchievementForGame(string|int $appid): array
    {
        try {
            $response = Http::get(getSteamEndpoint('achievements', ['appid' => $appid]));

            return $response->json()['achievementpercentages']['achievements'];
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function games(): Collection
    {
        ini_set('memory_limit', '512M');

        try {
            $apps = $this->fetchAppList();

            return $apps->map(fn ($app) => $this->fetchGameData($app))
                ->filter()
                ->values();
        } catch (\Exception $e) {
            report($e);
            throw new \Exception('Erro ao buscar jogos: ' . $e->getMessage());
        }
    }

    public function gameDetails(string $appid): array
    {
        try {
            $achievementsResp = Http::get(getSteamEndpoint('achievements', ['appid' => $appid]));
            $newsResponse     = Http::get(getSteamEndpoint('game_news', ['appid' => $appid]));

            return [
                'id'              => $appid,
                'achievements'    => $achievementsResp->json()['achievementpercentages']['achievements'] ?? [],
                'news'            => $newsResponse->json()['appnews']['newsitems'] ?? [],
            ];
        } catch (\Exception $e) {
            report($e);
            throw new \Exception('Erro ao buscar informações do jogo: ' . $e->getMessage());
        }
    }

    private function fetchAppList(): Collection
    {
        $response = Http::get(getSteamEndpoint('app_list'));

        return collect($response->json('applist.apps'))
            ->filter(fn($app) => !empty($app['name']))
            ->take(5);
    }

    private function fetchGameData(array $app): ?array
    {
        $detailsResponse = Http::get(getSteamEndpoint('game_details', ['appid' => $app['appid']]));
        $playersResponse = Http::get(getSteamEndpoint('players_online', ['appid' => $app['appid']]));

        if (!$detailsResponse->successful() || !$playersResponse->successful()) {
            return null;
        }

        $details = $detailsResponse->json()[$app['appid']]['data'] ?? null;
        $players = $playersResponse->json()['response']['player_count'] ?? null;

        if (!$details || ($details['type'] ?? '') !== 'game') {
            return null;
        }

        return [
            'id'                => $app['appid'],
            'name'              => $app['name'],
            'details'           => $details,
            'number_of_players' => $players,
        ];
    }
}
