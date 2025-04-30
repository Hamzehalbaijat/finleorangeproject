<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    public function run()
    {
        // Get some buses and passengers
        $bus1 = Bus::first();
        $bus2 = Bus::skip(1)->first();
        $passenger1 = User::where('role', 'passenger')->first();
        $passenger2 = User::where('role', 'passenger')->skip(1)->first();

        // Create sample trips
        $trips = [
            [
                'bus_id' => $bus1->id,
                'passenger_id' => $passenger1->id,
                'pickup_location' => 'Amman, 7th Circle',
                'pickup_latitude' => 31.9566,
                'pickup_longitude' => 35.9457,
                'destination' => 'Aqaba, City Center',
                'destination_latitude' => 29.5319,
                'destination_longitude' => 35.0061,
                'status' => 'on_board',
            ],
            [
                'bus_id' => $bus2->id,
                'passenger_id' => $passenger2->id,
                'pickup_location' => 'Irbid, University Street',
                'pickup_latitude' => 32.5556,
                'pickup_longitude' => 35.8500,
                'destination' => 'Amman, Downtown',
                'destination_latitude' => 31.9514,
                'destination_longitude' => 35.9240,
                'status' => 'waiting',
            ],
            [
                'bus_id' => $bus1->id,
                'passenger_id' => $passenger2->id,
                'pickup_location' => 'Zarqa, Main Station',
                'pickup_latitude' => 32.0667,
                'pickup_longitude' => 36.1000,
                'destination' => 'Madaba, City Center',
                'destination_latitude' => 31.7167,
                'destination_longitude' => 35.8000,
                'status' => 'dropped_off',
            ]
        ];

        foreach ($trips as $tripData) {
            Trip::create($tripData);
        }

        // Create additional random trips if needed
        $jordanCities = [
            ['Amman', 31.9454, 35.9284],
            ['Irbid', 32.5556, 35.8500],
            ['Zarqa', 32.0667, 36.1000],
            ['Aqaba', 29.5319, 35.0061],
            ['Madaba', 31.7167, 35.8000],
            ['Jerash', 32.2746, 35.8961],
            ['Salt', 32.0392, 35.7272]
        ];

        for ($i = 0; $i < 10; $i++) {
            $fromCity = $jordanCities[array_rand($jordanCities)];
            $toCity = $jordanCities[array_rand($jordanCities)];
            
            // Make sure from and to are different
            while ($fromCity[0] === $toCity[0]) {
                $toCity = $jordanCities[array_rand($jordanCities)];
            }

            Trip::create([
                'bus_id' => Bus::inRandomOrder()->first()->id,
                'passenger_id' => User::where('role', 'passenger')->inRandomOrder()->first()->id,
                'pickup_location' => $fromCity[0] . ', ' . $this->getRandomStreet(),
                'pickup_latitude' => $fromCity[1] + (rand(-50, 50) / 1000),
                'pickup_longitude' => $fromCity[2] + (rand(-50, 50) / 1000),
                'destination' => $toCity[0] . ', ' . $this->getRandomStreet(),
                'destination_latitude' => $toCity[1] + (rand(-50, 50) / 1000),
                'destination_longitude' => $toCity[2] + (rand(-50, 50) / 1000),
                'status' => ['waiting', 'on_board', 'dropped_off'][rand(0, 2)],
            ]);
        }
    }

    private function getRandomStreet()
    {
        $streets = [
            'Main Street', 'King Abdullah Street', 'University Street', 
            'Garden Street', 'Market Street', 'Station Street',
            'Park Street', 'Central Avenue', 'River Road'
        ];
        return $streets[array_rand($streets)] . ' ' . rand(1, 100);
    }
}