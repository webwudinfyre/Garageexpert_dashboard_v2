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
        Schema::create('product_adds', function (Blueprint $table) {
            $table->bigIncrements('product_id'); // Auto-incrementing primary key

            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('client_users');

            $table->unsignedBigInteger('warranties_id');
            $table->foreign('warranties_id')->references('id')->on('warranties');

            $table->unsignedBigInteger('type_services_id');
            $table->foreign('type_services_id')->references('id')->on('type_services');

            $table->unsignedBigInteger('equipment_id');
            $table->foreign('equipment_id')->references('id')->on('equipment');

            $table->timestamps(); // Adds created_at and updated_at columns for timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_adds');
    }
};
