<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveToPermanentPlacements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permanent_placements', function (Blueprint $table) {
            $table->boolean('active')->default(1)->after('approved');
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
            $table->dropColumn('active');
        });
    }
}
