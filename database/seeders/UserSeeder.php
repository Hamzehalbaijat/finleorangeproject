<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'phone' => '0790000001',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'balance' => 100.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Driver One',
                'email' => 'driver1@example.com',
                'phone' => '0790000002',
                'password' => Hash::make('password'),
                'role' => 'driver',
                'balance' => 50.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Passenger One',
                'email' => 'passenger1@example.com',
                'phone' => '0790000003',
                'password' => Hash::make('password'),
                'role' => 'passenger',
                'balance' => 20.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
