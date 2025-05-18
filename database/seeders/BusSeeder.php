<?php

namespace Database\Seeders;

use App\Models\Bus;
use Illuminate\Database\Seeder;

class BusSeeder extends Seeder
{
    public function run()
    {
        Bus::insert([
            [
                'driver_id' => 2,
                'complex_id' => 1,
                'plate_number' => 'JO-1234',
                'departure_time' => '08:00:00',
                'estimated_arrival_time' => '09:30:00',
                'from_location' => 'Amman',
                'to_location' => 'Zarqa',
                'current_latitude' => 31.955399,
                'current_longitude' => 35.928036,
                'total_capacity' => 40,
                'occupied_seats' => 15,
                'fee' => 1.50,
                'status1' => 'On the way',
                'status2' => 'Has empty seats',
                'color' => '#FF0000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}