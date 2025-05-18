<?php

namespace Database\Seeders;

use App\Models\PassengerBus;
use Illuminate\Database\Seeder;

class PassengerBusSeeder extends Seeder
{
    public function run()
    {
        PassengerBus::insert([
            [
                'passenger_id' => 3,
                'bus_id' => 1,
                'pickup_location' => '7th Circle, Amman',
                'pickup_latitude' => 31.963158,
                'pickup_longitude' => 35.866489,
                'destination' => 'Zarqa City Center',
                'destination_latitude' => 32.072333,
                'destination_longitude' => 36.094556,
                'status' => 'on_board',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}