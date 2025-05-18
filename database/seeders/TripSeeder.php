<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\RouteStop;
use Carbon\Carbon;

class TripSeeder extends Seeder
{
    public function run()
    {
        // Get all user IDs and route stop IDs
        $userIds = User::pluck('id');
        $routeStopIds = RouteStop::pluck('id');

        // Check if there's enough data to create trips
        if ($userIds->isEmpty() || $routeStopIds->count() < 2) {
            throw new \Exception("Insufficient data. Ensure there's at least 1 user and 2 route stops.");
        }

        $statuses = ['planned', 'in_progress', 'completed', 'cancelled'];

        // Create 50 sample trips
        foreach (range(1, 50) as $index) {
            // Get random user and route stops
            $userId = $userIds->random();
            
            do {
                $startStopId = $routeStopIds->random();
                $endStopId = $routeStopIds->random();
            } while ($startStopId === $endStopId);

            // Determine trip status and timestamps
            $status = $statuses[array_rand($statuses)];
            $now = Carbon::now();

            switch ($status) {
                case 'planned':
                    $startTime = $now->copy()->addDays(rand(1, 30));
                    $endTime = $startTime->copy()->addHours(rand(1, 24));
                    break;
                case 'in_progress':
                    $startTime = $now->copy()->subHours(rand(1, 5));
                    $endTime = $now->copy()->addHours(rand(1, 5));
                    break;
                case 'completed':
                    $startTime = $now->copy()->subDays(rand(1, 30));
                    $endTime = $startTime->copy()->addHours(rand(1, 24));
                    break;
                case 'cancelled':
                    $startTime = rand(0, 1) ? $now->copy()->addDays(rand(1, 30)) : null;
                    $endTime = null;
                    break;
                default:
                    $startTime = null;
                    $endTime = null;
            }

            // Insert trip record
            DB::table('trips')->insert([
                'user_id'        => $userId,
                'start_stop_id'  => $startStopId,
                'end_stop_id'    => $endStopId,
                'start_time'     => $startTime,
                'end_time'       => $endTime,
                'status'         => $status,
                'created_at'     => $now,
                'updated_at'     => $now,
            ]);
        }
    }
}