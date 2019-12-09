<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalCostToPermanentPlacements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permanent_placements', function (Blueprint $table) {
            $table->string('additional_cost')->default('None')->after('salary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permanent_placements', function (Blueprint $table) {
            $table->dropColumn('additional_cost');
        });
    }
}
