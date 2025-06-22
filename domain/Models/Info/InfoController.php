<?php

namespace Domain\Models\Info;

use Domain\BaseController;
use Domain\Models\Info\Resources\InfoGamesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoController extends BaseController {

    public function __construct(protected InfoService $service){}

    public function lookupMostPlayedGames(): JsonResource
    {
        return InfoGamesResource::collection($this->service->getIDSMostPlayedGames());
    }
}
