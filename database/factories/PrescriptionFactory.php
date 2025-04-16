<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prescription>
 */
class PrescriptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'profile_id' => \App\Models\Profile::factory(),
            'image' => fake()->imageUrl(),
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
            'medical_notes' => fake()->paragraph(),
        ];
    }
}