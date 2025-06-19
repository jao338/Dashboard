<?php

use Domain\Models\Auth\AuthController;
use Domain\Models\Dashboard\DashboardController;
use Domain\Models\Games\GamesController;
use Domain\Models\Info\InfoController;
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Auth'
], function (): void {
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('me', [AuthController::class, 'me'])->name('me')->middleware('auth:sanctum');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');

    // Rotas que montam os gráficos na tela inicial
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('numbers-players', [DashboardController::class, 'getColumnsChart']);
    });

    Route::group(['prefix' => 'games'], function () {
        Route::get('', [GamesController::class, 'games']);
        Route::get('/global-achievement', [GamesController::class, 'globalAchievementForGame']);
        Route::get('/details', [GamesController::class, 'gameDetails']);
    });

    // Rotas que retornam os dados usados para montar os componentes na SPA
    Route::group(['prefix' => 'info'], function () {
        Route::get('genres', [InfoController::class, 'getGenres']);
        Route::get('categories', [InfoController::class, 'getCategories']);
        Route::get('tags', [InfoController::class, 'getTags']);
        Route::get('most-played-games', [InfoController::class, 'getIDSMostPlayedGames']);
    });
});
