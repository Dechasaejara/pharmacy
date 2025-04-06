<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quotation>
 */
class QuotationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'prescription_id' => \App\Models\Prescription::factory(),
            'profile_id' => \App\Models\Profile::factory(),
            'pharmacy_id' => \App\Models\Pharmacy::factory(),
            'total_amount' => fake()->randomFloat(2, 50, 500),
            'status' => fake()->randomElement(['pending', 'accepted', 'rejected']),
            'valid_until' => fake()->dateTimeBetween('+1 week', '+1 month'),
            'notes' => fake()->paragraph(),
        ];
    }
}