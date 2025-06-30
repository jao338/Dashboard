<?php

namespace App\Jobs;

use Domain\Models\Games\Game;
use Domain\Models\Games\GameService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;


class SyncSteamGamesJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public function handle(GameService $gamesService): void
    {
        foreach ($gamesService->fetchTopGames() as $gameData) {
            Game::syncFromSteam($gameData);
        }
    }
}
