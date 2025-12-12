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
        Schema::create('outwardmodel_type1_t1s', function (Blueprint $table) {
            $table->id();
            $table->string('outward_number')->unique();
            $table->string('center')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('date')->nullable();
            $table->string('helper')->nullable();
            $table->string('driver')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('time_in')->nullable();
            $table->string('time_out')->nullable();
            $table->string('meter_in')->nullable();
            $table->string('meter_out')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->string('comment')->nullable();
            $table->string('Weight')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outwardmodel_type1_t1s');
    }
};
