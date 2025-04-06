<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LineItem>
 */
class LineItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'transaction_id' => \App\Models\Transaction::factory(),
            'inventory_id' => \App\Models\Inventory::factory(),
            'quantity' => fake()->numberBetween(1, 10),
            'unit_price' => fake()->randomFloat(2, 5, 100),
            'subtotal' => fake()->randomFloat(2, 50, 500),
            'instructions' => fake()->sentence(),
        ];
    }
}