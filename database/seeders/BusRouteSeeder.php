<?php

namespace Database\Seeders;

use App\Models\BusRoute;
use Illuminate\Database\Seeder;

class BusRouteSeeder extends Seeder
{
    public function run()
    {
        BusRoute::insert([
            [
                'bus_id' => 1,
                'route_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bus_id' => 2,
                'route_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}