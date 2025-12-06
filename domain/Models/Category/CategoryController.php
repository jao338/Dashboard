<?php

namespace Domain\Models\Category;

use App\Http\Controllers\Controller;
use Domain\Models\Category\Requests\CategoryFiltersRequest;
use Domain\Models\Category\Requests\CategoryRequest;
use Domain\Models\Category\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class CategoryController extends Controller {

    public function index(CategoryService $service, CategoryFiltersRequest $request): JsonResource
    {
        return CategoryResource::collection($service->index($request->all()));
    }
    public function store(CategoryService $service, CategoryRequest $request): JsonResource
    {
        return new CategoryResource($service->store($request->all()));
    }
    public function show(int $id_category, CategoryService $service): JsonResource
    {
        return new CategoryResource($service->show($id_category));
    }

    public function update(int $id_category, CategoryService $service, CategoryRequest $request): JsonResource
    {
        return new CategoryResource($service->update($id_category, $request->all()));
    }
    public function delete(int $id_category, CategoryService $service): Response
    {
        $service->delete($id_category);

        return response()->noContent();
    }

    public function lookup(CategoryService $service): JsonResource
    {
        return CategoryResource::collection($service->lookup());
    }
}
