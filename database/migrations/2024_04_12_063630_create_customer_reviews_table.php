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
        Schema::create('customer_reviews', function (Blueprint $table) {
            $table->id();

            $table->string('Product_reviews')->nullable();

            $table->string('tech_reviews')->nullable();

            $table->unsignedBigInteger('product_tasks_id');
            $table->foreign('product_tasks_id')->references('id')->on('product_tasks');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('product_id')->on('product_adds');

            $table->unsignedBigInteger('type_services_id');
            $table->foreign('type_services_id')->references('id')->on('type_services');

            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('users');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_reviews');
    }
};
