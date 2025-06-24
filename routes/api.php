<?php

use Domain\Models\Auth\AuthController;
use Domain\Models\Category\CategoryController;
use Domain\Models\Dashboard\DashboardController;
use Domain\Models\Games\GamesController;
use Domain\Models\Genre\GenreController;
use Domain\Models\Tag\TagController;
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Auth'
], function (): void {
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

/*
    **  NÃO APAGAR - https://chatgpt.com/c/68582671-1f60-800b-af91-844f30a0dd80 **
    **  NÃO APAGAR - https://chatgpt.com/c/685b042d-7ec0-800b-a703-62ce8cef46c6 **

    **  PENSAR NUMA SOLUÇÃO **
    **  Devo criar uma tabela com informações dos jogos? Usar estrégia híbrida sugerida pelo chat? Uma base local indexada com os 1000 jogos mais relevantes e atualizar via job a cada 3 dias? Para casos em que o usuário buscar e não encontrar nada na base local, buscar usando o endpoint e guardar no cache? **
    **  Como salvar as informações de tags, categorias e gêneros na base de dados? Obs. A steam NÃO possiu endpoints que retornem esses dados DIRETAMENTE, porém alguns endpoints retornam essas informações **

    **  FAZER **
    **  Usar jobs e redis e evitar fazer muitas requisições para as apis da steam. Volte bastante nessa conversa para saber mais. **
    **  Criar tabela auxiliar com imagens relacionadas ao usuário no perfil. A tabela deve ser usada APENAS quando o usuário não vinculou sua conta da Steam **
 */


Route::group([
        'middleware' => 'auth:sanctum'
    ], function () {
    Route::get('me', [AuthController::class, 'me'])->name('me')->middleware('auth:sanctum');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('most-played-games', [DashboardController::class, 'mostPlayedGames']);
    });

    Route::group(['prefix' => 'games'], function () {
        Route::get('', [GamesController::class, 'games']);
        Route::get('/global-achievement', [GamesController::class, 'globalAchievementForGame']);
        Route::get('/details', [GamesController::class, 'gameDetails']);
    });

    Route::group(['prefix' => 'lookups'], function () {
        Route::get('genres', [GenreController::class, 'lookup']);
        Route::get('tags', [TagController::class, 'lookup']);
        Route::get('categories', [CategoryController::class, 'lookup']);
    });
});
