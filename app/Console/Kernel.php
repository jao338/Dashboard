<?php

namespace App\Console;

use App\Jobs\SyncSteamGamesJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel {
    protected function schedule(Schedule $schedule): void
    {
        Log::info('Método schedule executado');
        $schedule->job(new SyncSteamGamesJob)->everyTwoMinutes();
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
