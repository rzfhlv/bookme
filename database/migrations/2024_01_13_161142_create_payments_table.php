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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->date('payment_date');
            $table->decimal('amount_paid', $precision = 15, $scale = 2);
            $table->enum('status', ['pending', 'settlement', 'challenge', 'deny', 'expire', 'cancel']);
            $table->jsonb('request_payload')->nullable();
            $table->jsonb('response_payload')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
