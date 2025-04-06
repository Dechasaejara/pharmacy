<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pharmacy>
 */
class PharmacyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'name' => fake()->company(),
            'license_number' => fake()->unique()->numerify('LIC-#####'),
            'location' => fake()->address(),
            'picture' => fake()->imageUrl(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'country' => fake()->country(),
            'state' => fake()->state(),
            'city' => fake()->city(),
        ];
    }
}