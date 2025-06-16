<?php

use Domain\Dashboard\DashboardController;
use Domain\Info\InfoController;
use Illuminate\Support\Facades\Route;
use Domain\Games\GamesController;

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
    Route::get('/globalAchievement', [GamesController::class, 'globalAchievementForGame']);
    //  Retorna os detalhes sobre um jogo específico
    Route::get('/details', [GamesController::class, 'gameDetails']);
});

// Info
Route::group(['prefix' => 'info'], function () {
    // Rotas que retornam os daos usados para montar os componentes na SPA
    Route::get('getGenres', [InfoController::class, 'getGenres']);
});
