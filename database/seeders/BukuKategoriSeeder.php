<?php

namespace Database\Seeders;

use App\Models\BukuKategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BukuKategori::truncate();
        BukuKategori::factory(10)->create();
    }
}
