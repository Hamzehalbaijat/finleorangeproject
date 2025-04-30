<?php
// database/migrations/xxxx_create_buses_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained('users');
            $table->foreignId('complex_id')->constrained('complexes');
            $table->string('plate_number')->unique();
            $table->time('departure_time');
            $table->time('estimated_arrival_time');
            $table->string('from_location');
            $table->string('to_location');
            $table->decimal('current_latitude', 10, 8)->nullable();
            $table->decimal('current_longitude', 11, 8)->nullable();
            $table->integer('total_capacity');
            $table->integer('occupied_seats')->default(0);
            $table->decimal('fee', 8, 2);
            $table->enum('status1', ['Being packed', 'On the way', 'Reached']);
            $table->enum('status2', ['Full', 'Has empty seats']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buses');
    }
};