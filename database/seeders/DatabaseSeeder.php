<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        UserSeeder::class,
        ComplexSeeder::class,
        RouteSeeder::class,
        RouteStopSeeder::class,
        BusSeeder::class,
        BusRouteSeeder::class,
        PaymentSeeder::class,
        ReviewSeeder::class,
        ReportSeeder::class,
        NotificationSeeder::class,
        ContactSeeder::class,
        PassengerBusSeeder::class,
        TripSeeder::class,
    ]);
    }
    
}
