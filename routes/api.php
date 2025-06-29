<?php

use Domain\Models\Auth\AuthController;
use Domain\Models\Category\CategoryController;
use Domain\Models\Dashboard\DashboardController;
use Domain\Models\Games\GameController;
use Domain\Models\Genre\GenreController;
use Domain\Models\Tag\TagController;
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Auth'
], function (): void {
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::get('/sanctum/csrf-cookie', function (\Illuminate\Http\Request $request) {
    return response()->noContent();
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
    **   Adicionar a chave "max_players_daily" no retorno de "fetchTopGames", no job o campo sempre vem como null **
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
        Route::get('', [GameController::class, 'fetchTopGames']);
        Route::get('/global-achievement', [GameController::class, 'globalAchievementForGame']);
        Route::get('/details', [GameController::class, 'gameDetails']);
    });

    //  Dispara o JOB que alimenta a tabela de games. Testar job com o kernel. Usar "php artisan queue:work" e "php artisan schedule:run" para testes
    Route::get('teste', function(){
        \App\Jobs\SyncSteamGamesJob::dispatch();

        return response()->json(['message' => 'Job dispatched com sucesso.']);
    });

//    Route::get('teste', function () {
//        return \Domain\Models\Games\Game::select(
//            'name',
//            'appid',
//            'icon',
//            'max_players_daily',
//            'last_synced_at',
//            'active'
//        )->orderBy('last_synced_at', 'desc')->get();
//    });

    Route::group(['prefix' => 'lookups'], function () {
        Route::get('genres', [GenreController::class, 'lookup']);
        Route::get('tags', [TagController::class, 'lookup']);
        Route::get('categories', [CategoryController::class, 'lookup']);
    });
});
