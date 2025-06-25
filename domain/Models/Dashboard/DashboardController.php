<?php

namespace Domain\Models\Dashboard;

use Domain\BaseController;
use Domain\Models\Dashboard\Resources\MostPlayedGamesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardController extends BaseController {

    public function __construct(protected DashboardService $service){}

    public function mostPlayedGames(): JsonResource
    {
        return MostPlayedGamesResource::collection($this->service->mostPlayedGames(5));
    }
}
