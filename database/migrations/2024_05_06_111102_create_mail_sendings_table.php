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
        Schema::create('mail_sendings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_tasks_id');
            $table->foreign('product_tasks_id')->references('id')->on('product_tasks');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('product_id')->on('product_adds');

            $table->string('email')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_sendings');
    }
};
