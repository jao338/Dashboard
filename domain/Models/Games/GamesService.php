<?php

namespace Domain\Models\Games;

use Domain\SteamHttpClient;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class GamesService
{
    public function __construct(
        protected SteamHttpClient $steam
    ) {}
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
        $apps = $this->steam->fetchAppList();

        return $apps
            ->filter(fn($app) => !empty($app['name']))
            ->take(5)
            ->map(fn($app) => $this->buildGameData($app))
            ->filter()
            ->values();
    }

    public function gameDetails(string|int $appid): array
    {
        return [
            'id'            => $appid,
            'achievements'  => $this->steam->fetchAchievements($appid),
            'news'          => $this->steam->fetchGameNews($appid),
        ];
    }


    private function buildGameData(array $app): ?array
    {
        $details = $this->steam->fetchGameDetails($app['appid']);
        $players = $this->steam->fetchPlayersOnline($app['appid']);

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
