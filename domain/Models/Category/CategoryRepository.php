<?php

namespace Domain\Models\Category;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository
{
    public function __construct(protected Category $model) { }

    public function index(array $data): LengthAwarePaginator
    {
        $name = $data['name'] ?? null;
        $tipo_ordenacao  = $data['tipo_ordenacao'] ?? 'ASC';
        $campo_ordenacao = $data['campo_ordenacao'] ?? 'name';
        $per_page        = $data['per_page'] ?? 20;

        return $this->model
                        ->when(isset($name), fn($query) => $query->where('name', 'LIKE', "%$name%"))
                        ->when(
                            isset($campo_ordenacao) && isset($tipo_ordenacao),
                            fn($query) => $query->orderBy($campo_ordenacao, $tipo_ordenacao)
                        )
                        ->paginate($per_page);
    }

    public function store(array $data): Category
    {
        return $this->model->create($data);
    }
    public function show(int $id_category): Category
    {
        return $this->model->findOrFail($id_category);
    }
    public function update(int $id_category, array $data): bool
    {
        return $this->model->findOrFail($id_category)->update($data);
    }
    public function delete(int $id_category): bool
    {
        return $this->model->findOrFail($id_category)->delete();
    }

    public function lookup(): Collection
    {
        return $this->model->select('name', 'icon')->orderBy('name')->get();
    }
}
