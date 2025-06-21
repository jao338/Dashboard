<?php

namespace Database\Seeders;

use Domain\Models\Genre\Genre;
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
                                    'name'              => 'Home',
                                    'icon'              => 'home',
                                ]);
    }
}
