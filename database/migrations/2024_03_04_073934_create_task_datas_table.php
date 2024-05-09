<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_datas', function (Blueprint $table) {
            $table->id();
            $table->string('task_name')->nullable();
            $table->timestamps();
        });
        DB::table('task_datas')->insert([
            ['task_name' => 'New Task'],
            ['task_name' => 'Pending'],
            ['task_name' => 'Quotation'],
            ['task_name' => 'Completed'],
            ['task_name' => 'Assign To Other'],
            ['task_name' => 'Waiting Approve'],


        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_datas');
    }
};
