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
        Schema::table('product_adds', function (Blueprint $table) {
            $table->string('date_of_schedule')->nullable();
            $table->string('Reamarks')->nullable();

            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_adds', function (Blueprint $table) {
            //
        });
    }
};
