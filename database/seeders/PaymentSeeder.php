<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        Payment::insert([
            [
                'user_id' => 3,
                'bus_id' => 1,
                'passenger_id' => 3,
                'nfc_card_id' => 'NFC-PAX-001',
                'transaction_id' => 'TXN-'.uniqid(),
                'amount' => 1.50,
                'status' => 'completed',
                'notes' => 'Morning commute payment',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}