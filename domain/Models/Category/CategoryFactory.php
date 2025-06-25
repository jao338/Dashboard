<?php

namespace Domain\Models\Category;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'icon' => fake()->name(),
        ];
    }
}
