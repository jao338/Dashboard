<?php

namespace Domain\Models\Games;

use Domain\BaseController;
use Domain\Models\Games\Requests\GameDetailsRequest;
use Domain\Models\Games\Requests\GameStatsRequest;
use Domain\Models\Games\Resources\GameDetailsExtraResource;
use Domain\Models\Games\Resources\GameAchievementsResource;
use Domain\Models\Games\Resources\GameResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GameController extends BaseController {

    public function __construct(protected GameService $service){}

    public function globalAchievementForGame(GameStatsRequest $request): JsonResource
    {
        return GameAchievementsResource::collection($this->service->globalAchievementForGame($request->input('id')));
    }

    public function fetchTopGames(): JsonResource
    {
        return GameResource::collection($this->service->fetchTopGames());
    }

    public function gameDetails(GameDetailsRequest $request): JsonResource
    {
        return GameDetailsExtraResource::collection(collect([$this->service->gameDetails($request->input('id'))]));
    }
}
