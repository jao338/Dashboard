<?php

namespace Domain\Info;

use Domain\BaseController;
use Domain\Info\Resources\InfoCategoriesResource;
use Domain\Info\Resources\InfoGamesResource;
use Domain\Info\Resources\InfoGenresResource;
use Domain\Info\Resources\InfoTagsResource;
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
