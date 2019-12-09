<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConvergeCompaniesToContractBillings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contract_billings', function (Blueprint $table) {
            $table->unsignedInteger('converge_company_id')->nullable()->after('user_id');
            $table->foreign('converge_company_id')
                ->references('id')
                ->on('converge_companies');
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
            $table->dropColumn('converge_company_id');
        });
    }
}
