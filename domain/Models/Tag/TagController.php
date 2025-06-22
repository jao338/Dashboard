<?php

namespace Domain\Models\Tag;

use App\Http\Controllers\Controller;
use Domain\Models\Tag\Resources\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TagController extends Controller {

    public function lookup(TagService $service): JsonResource
    {
        return TagResource::collection($service->lookup());
    }
}
