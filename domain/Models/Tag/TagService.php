<?php

namespace Domain\Models\Tag;

use Illuminate\Database\Eloquent\Collection;

class TagService
{
    public function __construct(protected TagRepository $repository) {}
    public function lookup(): Collection
    {
        return $this->repository->lookup();
    }
}
