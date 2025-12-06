<?php

namespace Domain\Models\Category;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryService
{
    public function __construct(protected CategoryRepository $repository) {}
    public function index(array $data): LengthAwarePaginator
    {
        return $this->repository->index($data);
    }
    public function store(array $data): Category
    {
        return $this->repository->store($data);
    }
    public function update(int $id_category, array $data): bool
    {
        return $this->repository->update($id_category, $data);
    }
    public function show(int $id_category): bool
    {
        return $this->repository->show($id_category);
    }
    public function delete(int $id_category): bool
    {
        return $this->repository->delete($id_category);
    }
    public function lookup(): Collection
    {
        return $this->repository->lookup();
    }
}
