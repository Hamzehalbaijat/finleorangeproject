<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        Review::insert([
            [
                'user_id' => 3,
                'bus_id' => 1,
                'driver_id' => 2,
                'rating' => 4,
                'comment' => 'Comfortable ride and professional service',
                'type' => 'bus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}