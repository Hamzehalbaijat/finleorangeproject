<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Complex;

class ComplexSeeder extends Seeder
{
    public function run(): void
    {
        Complex::create([
            'name' => 'Amman Station',
            'description' => 'Main bus station in Amman.',
            'location' => 'Amman, Jordan',
            'latitude' => 31.9539,
            'longitude' => 35.9106,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Complex::create([
            'name' => 'Zarqa Station',
            'description' => 'Main bus station in Zarqa.',
            'location' => 'Zarqa, Jordan',
            'latitude' => 32.0728,
            'longitude' => 36.0880,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Complex::create([
            'name' => 'Irbid Station',
            'description' => 'Main bus station in Irbid.',
            'location' => 'Irbid, Jordan',
            'latitude' => 32.5569,
            'longitude' => 35.8497,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
    }
}
