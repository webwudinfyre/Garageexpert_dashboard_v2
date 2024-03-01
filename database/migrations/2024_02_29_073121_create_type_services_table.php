<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('type_services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name')->nullable();
            $table->timestamps();
        });

        DB::table('type_services')->insert([
            ['service_name' => 'Installation'],
            ['service_name' => 'Insception'],
            ['service_name' => 'Complaint'],
            ['service_name' => 'Repair'],
            ['service_name' => 'Warranty'],
            ['service_name' => 'AMC'],

        ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_services');
    }
};
