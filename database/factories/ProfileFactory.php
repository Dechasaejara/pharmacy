<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'bio' => fake()->sentence(),
            'picture' => fake()->imageUrl(),
            'role' => fake()->randomElement(['user', 'admin']),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'date_of_birth' => fake()->date(),
            'gender' => fake()->randomElement(['male', 'female']),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'country' => fake()->country(),
            'state' => fake()->state(),
            'city' => fake()->city(),
        ];
    }
}