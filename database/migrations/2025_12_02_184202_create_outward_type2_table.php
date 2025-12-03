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
        Schema::create('outward_type2', function (Blueprint $table) {
            $table->string('outward_no')->unique()->first(); // auto-generated outward number first
            $table->id();
            $table->foreignId('center_id')->constrained('centers');
            $table->string('type');
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->date('date');
            $table->foreignId('driver_id')->constrained('drivers');
            $table->foreignId('helper_id')->constrained('helpers');
            $table->foreignId('vehicle_type_id')->constrained('vehicles'); // if using vehicles table for types
            $table->time('time_in');
            $table->time('time_out');
            $table->integer('meter_in');
            $table->integer('meter_out');
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outward_type2');
    }
};
