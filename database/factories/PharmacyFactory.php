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
            'name' => fake()->company(),
            'license_number' => fake()->unique()->numerify('LIC-#####'),
            'address' => fake()->address(),
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