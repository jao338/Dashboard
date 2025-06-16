<?php

namespace Domain\Dashboard;

use Domain\BaseService;
use Illuminate\Support\Facades\Http;

class DashboardService extends BaseService
{
    public function getColumnsChart(): array
    {
        try {

            $games = [
                ['appid' => 730, 'fallbackName' => 'Counter-Strike 2', 'peak_players' => 0],
                ['appid' => 570, 'fallbackName' => 'Dota 2', 'peak_players' => 0],
                ['appid' => 578080, 'fallbackName' => 'PUBG: BATTLEGROUNDS', 'peak_players' => 0],
                ['appid' => 1172470, 'fallbackName' => 'Apex Legends', 'peak_players' => 0],
            ];

            $results = [];

            foreach ($games as $game) {
                try {
                    $currentPlayers = Http::get(getSteamEndpoint('players_online', [
                        'appid' => $game['appid']
                    ]));

                    $details = Http::get(getSteamEndpoint('game_details', [
                        'appid' => $game['appid']
                    ]));

                    $jsonDetails = $details->json()[$game['appid']]['data'] ?? null;

                    $results[] = [
                        'title'          => $jsonDetails['name'] ?? $game['fallbackName'],
                        'current_players' => $currentPlayers->json()['response']['player_count'] ?? 0,
                        'peak_players'    => $game['peak_players'],
                    ];
                } catch (\Exception $e) {
                    report($e);
                }
            }

            return $results;
        }catch (\Exception $e){
            report($e);
            throw new \Exception('Erro ao buscar jogos: ' . $e->getMessage());
        }
    }
}
