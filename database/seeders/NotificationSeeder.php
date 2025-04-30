<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\Bus;
class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        Notification::create([
            'user_id' => 3,
            'title' => 'Trip Reminder',
            'message' => 'Your bus to Zarqa leaves in 1 hour.',
            'is_read' => false,
            'notifiable_id' => 1, // ID الباص مثلاً أو المستخدم
            'notifiable_type' => Bus::class,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
