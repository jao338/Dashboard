<?php

namespace Domain\Models\Genre;

use App\Http\Controllers\Controller;
use Domain\Models\Genre\Resources\GenreResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GenreController extends Controller {

    public function lookup(GenreService $service): JsonResource
    {
        return new GenreResource($service->lookup());
    }
}
