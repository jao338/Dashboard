<?php

namespace Domain\Models\Info;

use Domain\BaseController;
use Domain\Models\Info\Resources\InfoCategoriesResource;
use Domain\Models\Info\Resources\InfoGamesResource;
use Domain\Models\Info\Resources\InfoGenresResource;
use Domain\Models\Info\Resources\InfoTagsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoController extends BaseController {

    public function __construct(protected InfoService $service){}

    public function getGenres(): JsonResource
    {
        return InfoGenresResource::collection($this->service->getGenres());
    }
    public function getCategories(): JsonResource
    {
        return InfoCategoriesResource::collection($this->service->getCategories());
    }
    public function getTags(): JsonResource
    {
        return InfoTagsResource::collection($this->service->getTags());
    }
    public function getIDSMostPlayedGames(): JsonResource
    {
        return InfoGamesResource::collection($this->service->getIDSMostPlayedGames());
    }
}
