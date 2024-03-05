<?php

namespace Database\Seeders;

use App\Models\BukuUlasan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuUlasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BukuUlasan::truncate();
        BukuUlasan::factory(10)->create();
    }
}
