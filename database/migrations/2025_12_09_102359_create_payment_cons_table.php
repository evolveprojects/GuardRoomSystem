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
        Schema::create('payment_cons', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('trip')->nullable();             // No column (like aod_td)
            $table->string('km_min')->nullable();
            $table->string('km_max')->nullable();
            $table->string('weight_min')->nullable();
            $table->string('weight_max')->nullable();
            $table->string('driver_amount')->nullable();
            $table->string('helper_amount')->nullable();
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
        Schema::dropIfExists('payment_cons');
    }
};
