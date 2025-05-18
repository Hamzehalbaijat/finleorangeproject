<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        Notification::insert([
            [
                'user_id' => 3,
                'title' => 'Trip Reminder',
                'message' => 'Your bus to Zarqa departs in 30 minutes',
                'type' => 'trip',
                'data' => json_encode(['bus_id' => 1]),
                'is_read' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}