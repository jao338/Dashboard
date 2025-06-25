<?php

namespace Domain\Models\Games;

use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    protected $model = Game::class;
    public function definition(): array
    {
        return [
            'name'                  => fake()->name(),
            'icon'                  => fake()->name(),
            'appid'                 => fake()->numberBetween(1, 99999),
            'last_synced_at'        => now(),
            'max_players_daily'     => fake()->numberBetween(1, 99999),
            'active'                => fake()->numberBetween(0, 1),
        ];
    }
}
