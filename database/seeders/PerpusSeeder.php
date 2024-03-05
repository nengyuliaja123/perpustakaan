<?php

namespace Database\Seeders;

use App\Models\Perpus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerpusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Perpus::truncate();
        Perpus::factory(10)->create();
    }
}
