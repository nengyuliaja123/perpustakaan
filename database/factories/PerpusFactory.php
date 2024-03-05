<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Perpus>
 */
class PerpusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $city = fake()->city();
        return [
            'nama_perpus' => 'Perpustakaan ' . $city,
            'alamat' => 'Jl. Raya No. ' . fake()->numberBetween(1, 10) . ', ' . $city,
            'tlp_hp' => fake()->phoneNumber(),
        ];
    }
}
