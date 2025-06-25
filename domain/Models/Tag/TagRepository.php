<?php

namespace Domain\Models\Tag;

use Illuminate\Database\Eloquent\Collection;

class TagRepository
{
    public function __construct(protected Tag $model) { }

    public function lookup(): Collection
    {
        return $this->model->select('name', 'icon')->orderBy('name')->get();
    }
}
