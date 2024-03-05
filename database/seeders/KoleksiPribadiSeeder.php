<?php

namespace Database\Seeders;

use App\Models\KoleksiPribadi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KoleksiPribadiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KoleksiPribadi::truncate();
        KoleksiPribadi::factory(10)->create();
    }
}
