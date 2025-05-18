<?php

namespace Database\Seeders;

use App\Models\Route;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    public function run()
    {
        Route::insert([
            [
                'name' => 'Amman to Zarqa Express',
                'description' => 'Direct route between Amman and Zarqa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Amman to Irbid Corridor',
                'description' => 'Main route connecting Amman to Irbid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}