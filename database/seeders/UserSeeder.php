<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected static ?string $password;

    public function run(): void
    {
        // user::truncate();
        // User::create([
        //     'perpus_id' => 0,
        //     'username' => 'admin',
        //     'password' => static::$password ??= Hash::make('password'),
        //     'email' => 'admin@example.com',
        //     'nama_lengkap' => 'Admin',
        //     'no_hp' => fake()->phoneNumber(),
        //     'alamat' => fake()->address(),
        //     'access_level' => 'admin',
        // ]);
        User::factory(100)->create();
    }
}
