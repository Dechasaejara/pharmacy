<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pharmacy_id' => \App\Models\Pharmacy::factory(),
            'product_id' => \App\Models\Product::factory(),
            'batch_number' => fake()->numerify('BATCH-#####'),
            'manufacturer' => fake()->company(),
            'expiry_date' => fake()->dateTimeBetween('+1 year', '+3 years'),
            'quantity' => fake()->numberBetween(10, 100),
            'unit_price' => fake()->randomFloat(2, 5, 100),
            'tax' => fake()->randomFloat(2, 0, 10),
            'storage_location' => fake()->word(),
            'is_active' => fake()->boolean(),
        ];
    }
}