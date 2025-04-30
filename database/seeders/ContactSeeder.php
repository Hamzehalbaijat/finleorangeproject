<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        Contact::create([
            'user_id' => 3,
            'name' => 'Passenger One',
            'email' => 'passenger1@example.com',
            'subject' => 'Lost item',
            'message' => 'I forgot my bag in the bus.',
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
