<?php

use Domain\Dashboard\DashboardController;
use Domain\Games\GamesController;
use Domain\Info\InfoController;
use Illuminate\Support\Facades\Route;

// Middleware
Route::group(['middleware' => 'auth:api'], function () {
    // Definir quais rotas ficarão aqui. Provalemente toda rota que necessite de um steam id válido, deve ficar dentro do middleware. Criar middleware específico para autenticação da steam?
});

//  Dashboard
Route::group(['prefix' => 'dashboard'], function () {
    // Rotas que montam os gráficos na tela inicial
    Route::get('numbers-players', [DashboardController::class, 'getColumnsChart']);
});

//  Games
Route::group(['prefix' => 'games'], function () {
    //  Retorna um conjunto de informações sobre 5 jogos, pode melhorar
    Route::get('', [GamesController::class, 'games']);
    //  Retorna as conquistas globais de um jogo específico
    Route::get('/global-achievement', [GamesController::class, 'globalAchievementForGame']);
    //  Retorna os detalhes sobre um jogo específico
    Route::get('/details', [GamesController::class, 'gameDetails']);
});

// Info
Route::group(['prefix' => 'info'], function () {
    // Rotas que retornam os dados usados para montar os componentes na SPA
    Route::get('genres', [InfoController::class, 'getGenres']);
    Route::get('categories', [InfoController::class, 'getCategories']);
    Route::get('tags', [InfoController::class, 'getTags']);
    Route::get('most-played-games', [InfoController::class, 'getIDSMostPlayedGames']);
});
