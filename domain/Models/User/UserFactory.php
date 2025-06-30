<?php

namespace Domain\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telephony' => fake()->numerify('###########'),
            'access_type' => fake()->randomNumber(1),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'password' => bcrypt(env('DEFAULT_PASSWORD')),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
