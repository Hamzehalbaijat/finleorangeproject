<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        Payment::create([
            'user_id' => 3, // Passenger One
            'bus_id' => 1,
            'passenger_id' => 3,
            'payment_method' => 'nfc',
            'transaction_id' => 'TXN123456',
            'amount' => 1.50,
            'status' => 'completed',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
