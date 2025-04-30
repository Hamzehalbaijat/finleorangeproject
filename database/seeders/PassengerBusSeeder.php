<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\PassengerBus;

class PassengerBusSeeder extends Seeder
{
    public function run(): void
    {
        PassengerBus::create([
            'passenger_id' => 3, // User with role 'passenger'
            'bus_id' => 1,
            'pickup_location' => 'Amman Terminal',
            'pickup_latitude' => 31.9539,
            'pickup_longitude' => 35.9106,
            'destination' => 'Zarqa Station',
            'destination_latitude' => 32.0728,
            'destination_longitude' => 36.0880,
            'status' => 'on_board',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
