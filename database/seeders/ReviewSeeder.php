<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        Review::create([
            'user_id' => 3,
            'bus_id' => 1,
            'rating' => 4,
            'comment' => 'Clean bus and friendly driver.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
