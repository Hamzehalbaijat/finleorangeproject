<?php

namespace Database\Seeders;

use App\Models\RouteStop;
use Illuminate\Database\Seeder;

class RouteStopSeeder extends Seeder
{
    public function run()
    {
        RouteStop::insert([
            [
                'route_id' => 1,
                'name' => 'Amman 7th Circle',
                'latitude' => 31.963158,
                'longitude' => 35.866489,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'route_id' => 1,
                'name' => 'Al Muwaqqar',
                'latitude' => 31.901944,
                'longitude' => 36.094722,
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'route_id' => 1,
                'name' => 'Zarqa Center',
                'latitude' => 32.072333,
                'longitude' => 36.094556,
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Amman to Irbid Route (Route ID 2)
            [
                'route_id' => 2,
                'name' => 'Amman North Station',
                'latitude' => 32.022778,
                'longitude' => 35.856389,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'route_id' => 2,
                'name' => 'Jerash Junction',
                'latitude' => 32.274444,
                'longitude' => 35.895278,
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'route_id' => 2,
                'name' => 'Irbid Downtown',
                'latitude' => 32.555556,
                'longitude' => 35.85,
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}