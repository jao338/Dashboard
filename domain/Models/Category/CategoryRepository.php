<?php

namespace Domain\Models\Category;

use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    public function __construct(protected Category $model) { }

    public function lookup(): Collection
    {
        return $this->model->select('name', 'icon')->orderBy('name')->get();
    }
}
