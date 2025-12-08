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
        Schema::create('outward_type2_t2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('outward_id')->index(); // FK to outward_type2
            $table->string('no')->nullable();                  // No column (like aod_td)
            $table->string('item')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('amount', 12, 2)->nullable();
            $table->timestamps();

            $table->foreign('outward_id')
                ->references('id')
                ->on('outward_type2')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outward_type2_t2');
    }
};
