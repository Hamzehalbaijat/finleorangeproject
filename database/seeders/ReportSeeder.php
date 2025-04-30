<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Report;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        Report::create([
            'user_id' => 3,
            'bus_id' => 1,
            'message' => 'The driver was late.',
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
