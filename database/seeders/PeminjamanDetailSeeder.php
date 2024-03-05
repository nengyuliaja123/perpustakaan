<?php

namespace Database\Seeders;

use App\Models\PeminjamanDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeminjamanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PeminjamanDetail::truncate();
        // PeminjamanDetail::factory(10)->create();
    }
}
