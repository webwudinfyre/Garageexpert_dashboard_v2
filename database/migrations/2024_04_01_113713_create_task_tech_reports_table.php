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
        Schema::create('task_tech_reports', function (Blueprint $table) {
            $table->id();
            $table->string('product_task_id')->nullable();
            $table->string('tech_user_id')->nullable();
            $table->string('date_of_schedule')->nullable();
            $table->string('date')->nullable();
            $table->string('task_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_tech_reports');
    }
};
