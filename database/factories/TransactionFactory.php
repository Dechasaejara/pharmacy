<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'quotation_id' => \App\Models\Quotation::factory(),
            'profile_id' => \App\Models\Profile::factory(),
            'pharmacy_id' => \App\Models\Pharmacy::factory(),
            'total_amount' => fake()->randomFloat(2, 50, 500),
            'status' => fake()->randomElement(['pending', 'approved', 'rejected', 'accepted']),
            'completed_at' => fake()->optional()->dateTime(),
        ];
    }
}