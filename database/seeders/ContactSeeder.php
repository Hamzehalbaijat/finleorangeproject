<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run()
    {
        Contact::insert([
            [
                'user_id' => 3,
                'name' => 'Sara Mohammad',
                'email' => 'sara@jo-bus.com',
                'subject' => 'Lost Item',
                'message' => 'I left my bag on bus JO-1234',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}