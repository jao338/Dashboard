<?php

namespace Domain\Models\Dashboard;

use Illuminate\Support\Facades\Http;

class DashboardService
{
    public function mostPlayedGames(int $limit = 10): array
    {
        try {
            $response = Http::get(getSteamEndpoint('most_played_games'));

            $games = $response->json()['response']['ranks'] ?? [];

            if (empty($games)) {
                throw new \Exception('Nenhum jogo retornado pela API da Steam.');
            }

            $games = array_slice($games, 0, $limit);

            $results = [];

            foreach ($games as $game) {
                try {
                    $details = Http::get(getSteamEndpoint('game_details', [
                        'appid' => $game['appid']
                    ]));

                    $jsonDetails = $details->json()[$game['appid']]['data'] ?? [];

                    $current = Http::get(getSteamEndpoint('players_online', [
                        'appid' => $game['appid']
                    ]));

                    $currentPlayers = $current->json()['response']['player_count'] ?? 0;

                    $results[] = [
                        'title'           => $jsonDetails['name'] ?? 'Desconhecido',
                        'appid'           => $game['appid'] ?? 0,
                        'current_players' => $currentPlayers,
                        'peak_players'    => $game['peak_in_game'] ?? 0,
                    ];
                } catch (\Exception $e) {
                    report($e);
                }
            }

            return $results;
        } catch (\Exception $e) {
            report($e);
            throw new \Exception('Erro ao buscar jogos mais jogados: ' . $e->getMessage());
        }
    }
}
