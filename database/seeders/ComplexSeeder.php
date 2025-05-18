<?php

namespace Database\Seeders;

use App\Models\Complex;
use Illuminate\Database\Seeder;

class ComplexSeeder extends Seeder
{
    public function run()
    {
        Complex::insert([
            [
                'name' => 'Amman Central Station',
                'description' => 'Main bus terminal in Amman',
                'location' => 'Amman, Jordan',
                'latitude' => 31.955399,
                'longitude' => 35.928036,
                'image' => 'amman-station.jpg',
                'opening_time' => '05:00:00',
                'closing_time' => '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Zarqa Transport Complex',
                'description' => 'Main transportation hub in Zarqa',
                'location' => 'Zarqa, Jordan',
                'latitude' => 32.076671,
                'longitude' => 36.088959,
                'image' => 'zarqa-station.jpg',
                'opening_time' => '06:00:00',
                'closing_time' => '22:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}