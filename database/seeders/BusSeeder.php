<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Bus;

class BusSeeder extends Seeder
{
    public function run(): void
    {
        Bus::create([
            'driver_id' => 2, // Driver One
            'complex_id' => 1,
            'plate_number' => '20-12345',
            'departure_time' => '08:00:00',
            'estimated_arrival_time' => '09:30:00',
            'from_location' => 'Amman',
            'to_location' => 'Zarqa',
            'current_latitude' => 31.9632,
            'current_longitude' => 35.9308,
            'total_capacity' => 20,
            'occupied_seats' => 5,
            'fee' => 1.50,
            'status1' => 'On the way',
            'status2' => 'Has empty seats',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
