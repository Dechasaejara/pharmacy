<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'generic_name' => fake()->word(),
            'brand_name' => fake()->company(),
            'description' => fake()->paragraph(),
            'picture' => fake()->imageUrl(),
        ];
    }
}