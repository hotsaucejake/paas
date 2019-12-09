<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTerminationDateToContractBillings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contract_billings', function (Blueprint $table) {
            $table->date('termination_date')->nullable()->after('contract_period');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contract_billings', function (Blueprint $table) {
            $table->dropColumn('termination_date');
        });
    }
}
