<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'name' => 'Admin',
            'email_verified_at' => now(),
        ]);
    }
}
