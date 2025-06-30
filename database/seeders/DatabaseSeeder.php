<?php

namespace Database\Seeders;

use Domain\Models\Category\Category;
use Domain\Models\Games\Game;
use Domain\Models\Genre\Genre;
use Domain\Models\Tag\Tag;
use Domain\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
                                    'name'              => 'Admin',
                                    'email'             => 'admin@teste.com',
                                    'password'          => bcrypt(env('DEFAULT_PASSWORD')),
                                    'telephony'         => fake()->numerify('###########'),
                                    'access_type'       => fake()->randomNumber(1),
                                    'email_verified_at' => now(),
                                    'remember_token'    => Str::random(10),
                                ]);

        Genre::factory()->create([
                                     'name' => 'Lorem',
                                     'icon' => 'home',
                                 ]);
        Tag::factory()->create([
                                   'name' => 'Lorem',
                                   'icon' => 'home',
                               ]);
        Category::factory()->create([
                                        'name' => 'Lorem',
                                        'icon' => 'home',
                                    ]);
        Game::factory()->create([
                                    'name'              => 'CS GO 2',
                                    'icon'              => null,
                                    'appid'             => 730,
                                    'last_synced_at'    => now(),
                                    'max_players_daily' => fake()->numberBetween(1, 99999),
                                    'active'            => fake()->numberBetween(0, 1),
                                ]);
    }
}
