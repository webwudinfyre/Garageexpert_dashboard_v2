<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClientIdToSignaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('signatures', function (Blueprint $table) {
            // Add a new client_id column to the signatures table
            $table->unsignedBigInteger('client_id')->nullable()->after('product_tasks_id');
        });

        // Populate the client_id column in the signatures table where client_id is null
        DB::table('signatures')->whereNull('client_id')->update([
            'client_id' => DB::raw('(SELECT client_id FROM product_tasks WHERE product_tasks.id = signatures.product_tasks_id)')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('signatures', function (Blueprint $table) {
            $table->dropColumn('client_id');
        });
    }
}
