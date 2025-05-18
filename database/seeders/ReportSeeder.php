<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    public function run()
    {
        Report::insert([
            [
                'user_id' => 3,
                'bus_id' => 1,
                'driver_id' => 2,
                'title' => 'Late Departure',
                'message' => 'Bus departed 15 minutes late',
                'type' => 'service',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}