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
        Schema::create('outwardmodel_type1_t2s', function (Blueprint $table) {
            $table->id();
            $table->string('aod_td')->nullable();
            $table->string('outward_id')->nullable();
            $table->string('seq_td')->nullable();
            $table->string('item_se')->nullable();
            $table->string('qty_se')->nullable();
            $table->string('customer_se')->nullable();
            $table->string('amount_se')->nullable();

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
        Schema::dropIfExists('outwardmodel_type1_t2s');
    }
};
