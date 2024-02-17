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
        Schema::create('bill_detail', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255);
            $table->string('name', 255);
            $table->text('room_name');
            $table->integer('room_price');
            $table->date('date_start');
            $table->date('date_end');
            $table->integer('pre_water');
            $table->integer('current_water');
            $table->integer('water_price');
            $table->integer('pre_electricity');
            $table->integer('current_electricity');
            $table->integer('electricity_price');
            $table->integer('total_price_service');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_detail');
    }
};
