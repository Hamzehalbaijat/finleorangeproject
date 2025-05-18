<?php
// database/migrations/xxxx_create_reports_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('bus_id')->nullable()->constrained('buses');
            $table->foreignId('driver_id')->nullable()->constrained('users');
            $table->string('title');
            $table->text('message');
            $table->enum('type', ['bus', 'driver', 'service', 'other'])->default('other');
            $table->enum('status', ['pending', 'in_progress', 'resolved', 'rejected'])->default('pending');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
};