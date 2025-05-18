<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@jo-bus.com',
                'phone' => '962790000001',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'balance' => 1000.00,
                'nfc_card_id' => 'NFC-ADM-001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Driver Ahmad',
                'email' => 'ahmad@jo-bus.com',
                'phone' => '962790000002',
                'password' => Hash::make('password'),
                'role' => 'driver',
                'balance' => 500.00,
                'nfc_card_id' => 'NFC-DRV-001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Passenger Sara',
                'email' => 'sara@jo-bus.com',
                'phone' => '962790000003',
                'password' => Hash::make('password'),
                'role' => 'passenger',
                'balance' => 150.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}