<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conselor_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('schedule_id');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['scheduled', 'confirmed', 'cancelled', 'completed', 'no_show'])->default('scheduled');
            $table->timestamps();

            $table->foreign('conselor_id')->references('id')->on('conselors');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('schedule_id')->references('id')->on('schedules');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
