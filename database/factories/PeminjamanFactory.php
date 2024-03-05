<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peminjaman>
 */
class PeminjamanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'perpus_id' => fake()->numberBetween(1, 3),
            'tanggal_pinjam' => fake()->date(),
            'user_id' => fake()->numberBetween(2, 4),
            'tanggal_kembali' => fake()->date(),
            'status_pinjam' => 'Belum selesai',
        ];
    }
}
