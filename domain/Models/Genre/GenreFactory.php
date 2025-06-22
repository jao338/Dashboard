<?php

namespace Domain\Models\Genre;

use Illuminate\Database\Eloquent\Factories\Factory;

class GenreFactory extends Factory
{
    protected $model = Genre::class;
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'icon' => fake()->name(),
        ];
    }
}
