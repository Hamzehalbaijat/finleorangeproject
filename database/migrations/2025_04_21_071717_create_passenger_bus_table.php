<?php
// database/migrations/xxxx_create_passenger_bus_table.php
// database/migrations/xxxx_create_passenger_bus_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('passenger_bus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('passenger_id')->constrained('users');
            $table->foreignId('bus_id')->constrained('buses');
            $table->string('pickup_location');
            $table->decimal('pickup_latitude', 10, 8);
            $table->decimal('pickup_longitude', 11, 8);
            $table->string('destination');
            $table->decimal('destination_latitude', 10, 8);
            $table->decimal('destination_longitude', 11, 8);
            $table->enum('status', ['waiting', 'on_board', 'dropped_off'])->default('waiting');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('passenger_bus');
    }
};