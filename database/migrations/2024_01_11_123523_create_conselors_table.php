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
        Schema::create('conselors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->date('dob');
            $table->decimal('fee', $precision = 15, $scale = 2);
            $table->jsonb('skill');
            $table->string('picture');
            $table->jsonb('education');
            $table->unsignedBigInteger('user_id')->unique();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conselors');
    }
};
