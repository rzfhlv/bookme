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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('appointment_id')->unique();
            $table->decimal('appointment_fee', $precision = 15, $scale = 2);
            $table->decimal('admin_fee', $precision = 15, $scale = 2);
            $table->decimal('total_amount', $precision = 15, $scale = 2);
            $table->date('order_date');
            $table->enum('status', ['pending', 'success', 'cancelled', 'failed'])->default('pending');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('appointment_id')->references('id')->on('appointments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
