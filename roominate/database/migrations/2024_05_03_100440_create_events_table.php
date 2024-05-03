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
        // Create a new migration file for events
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('name', 255);
            $table->text('description');
            $table->timestamp('start_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('reservation_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('reservation_id')->references('reservation_id')->on('reservations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};