<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Schema::create('trips', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('bus_id')->constrained()->cascadeOnDelete();
        //     $table->foreignId('passenger_id')->constrained('users')->cascadeOnDelete();
        //     $table->string('pickup_location');
        //     $table->decimal('pickup_latitude', 10, 8);
        //     $table->decimal('pickup_longitude', 11, 8);
        //     $table->string('destination');
        //     $table->decimal('destination_latitude', 10, 8);
        //     $table->decimal('destination_longitude', 11, 8);
        //     $table->timestamp('departure_time')->nullable();
        //     $table->enum('status', ['waiting', 'on_board', 'dropped_off'])->default('waiting');
        //     $table->timestamps();
        //     $table->softDeletes();
        // });

        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('start_stop_id')->constrained('route_stops');
            $table->foreignId('end_stop_id')->constrained('route_stops');
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->enum('status', ['planned', 'in_progress', 'completed', 'cancelled'])->default('planned');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trips');
    }
};