<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BukuUlasan>
 */
class BukuUlasanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'buku_id' => fake()->numberBetween(1, 3),
            'user_id' => fake()->numberBetween(1, 3),
            'ulasan' => fake()->paragraph(),
            'rating' => fake()->numberBetween(1, 5),
        ];
    }
}
