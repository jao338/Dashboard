<?php

namespace Domain\Models\Games;

use Domain\SteamHttpClient;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class GameService
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

    public function fetchTopGames(): Collection
    {
        return $this->steam->fetchAppList()
                           ->filter(fn($app) => !empty($app['name']))
                           ->take(20)
                           ->map(function ($app) {
                               return $this->fetchGameData($app['appid'], $app['name']);
                           })
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


    public function fetchGameData(int $appid, string $name): ?array
    {
        $details = $this->steam->fetchGameDetails($appid);
        $players = $this->steam->fetchPlayersOnline($appid);

        if (!$details || ($details['type'] ?? '') !== 'game') {
            return null;
        }

        return [
            'id'                => $appid,
            'name'              => $name,
            'icon'              => $details['header_image'] ?? null,
            'details'           => $details,
            'number_of_players' => $players,
        ];
    }

}
