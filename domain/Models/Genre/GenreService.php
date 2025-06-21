<?php

namespace Domain\Models\Genre;

use Illuminate\Database\Eloquent\Collection;

class GenreService
{
    public function __construct(protected GenreRepository $repository) {

    }
    public function lookup(): Collection
    {
        return $this->repository->lookup();
    }
}
