<?php

namespace Domain\Info;

use Domain\BaseController;
use Domain\Info\Resources\InfoGenresResource;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoController extends BaseController {

    public function __construct(protected InfoService $service){}

    public function getGenres(): JsonResource
    {
        return InfoGenresResource::collection($this->service->getGenres());
    }
}
