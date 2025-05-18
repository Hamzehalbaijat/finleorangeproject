<?php
// database/migrations/xxxx_create_reviews_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('bus_id')->constrained('buses');
            $table->foreignId('driver_id')->constrained('users');
            $table->integer('rating')->between(1, 5);
            $table->text('comment')->nullable();
            $table->enum('type', ['bus', 'driver', 'service'])->default('bus');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};