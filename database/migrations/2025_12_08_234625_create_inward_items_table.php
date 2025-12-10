<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inward_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inward_id')->constrained('inwards')->onDelete('cascade');
            $table->integer('sr_no')->nullable();
            $table->string('item_name');
            $table->integer('quantity');
            $table->decimal('amount', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inward_items');
    }
};
