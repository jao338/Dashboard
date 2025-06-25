<?php

namespace Domain\Models\Category;

use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function __construct(protected CategoryRepository $repository) {}
    public function lookup(): Collection
    {
        return $this->repository->lookup();
    }
}
