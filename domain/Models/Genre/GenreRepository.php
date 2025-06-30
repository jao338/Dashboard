<?php

namespace Domain\Models\Genre;

use Illuminate\Database\Eloquent\Collection;

class GenreRepository
{
    public function __construct(protected Genre $model) { }

    public function lookup(): Collection
    {
        return $this->model->select('name', 'icon')->orderBy('name')->get();
    }
}
