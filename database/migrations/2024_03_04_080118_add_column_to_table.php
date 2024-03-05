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
        Schema::table('product_tasks', function (Blueprint $table) {

            $table->unsignedBigInteger('task_id');
            $table->foreign('task_id')->references('id')->on('task_datas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_tasks', function (Blueprint $table) {
            //
        });
    }
};
