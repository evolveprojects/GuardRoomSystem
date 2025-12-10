<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inwards', function (Blueprint $table) {
            $table->id();
            $table->string('inward_no')->unique()->nullable();
            $table->foreignId('center_id')->constrained('centers')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->date('date');
            $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade');
            $table->foreignId('helper_id')->constrained('helpers')->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->string('bill_no')->nullable();
            $table->string('supplier')->nullable();
            $table->string('goods_in_no')->nullable();
            $table->string('to_member')->nullable();
            $table->text('comments')->nullable();
            $table->enum('status', ['ongoing', 'completed'])->default('ongoing');
            $table->foreignId('created_by')->constrained('users')->onDelete('no action');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('no action');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inwards');
    }
};
