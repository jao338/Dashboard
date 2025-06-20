<?php

namespace Domain\Models\Games;

use Domain\BaseController;
use Domain\Models\Games\Requests\GameDetailsRequest;
use Domain\Models\Games\Requests\GameStatsRequest;
use Domain\Models\Games\Resources\GameDetailsExtraResource;
use Domain\Models\Games\Resources\GamesAchievementsResource;
use Domain\Models\Games\Resources\GamesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GamesController extends BaseController {

    public function __construct(protected GamesService $service){}

    public function globalAchievementForGame(GameStatsRequest $request): JsonResource
    {
        return GamesAchievementsResource::collection($this->service->globalAchievementForGame($request->input('id')));
    }

    public function games(): JsonResource
    {
        return GamesResource::collection($this->service->games());
    }

    public function gameDetails(GameDetailsRequest $request): JsonResource
    {
        return GameDetailsExtraResource::collection(collect([$this->service->gameDetails($request->input('id'))]));
    }
}
