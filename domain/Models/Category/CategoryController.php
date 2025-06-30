<?php

namespace Domain\Models\Category;

use App\Http\Controllers\Controller;
use Domain\Models\Category\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryController extends Controller {

    public function lookup(CategoryService $service): JsonResource
    {
        return CategoryResource::collection($service->lookup());
    }
}
