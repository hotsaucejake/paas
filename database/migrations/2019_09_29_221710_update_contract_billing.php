<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateContractBilling extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("ALTER TABLE `contract_billings` CHANGE `issued_hardware` `issued_hardware` varchar(255) NOT NULL AFTER `project_type`");
        Schema::table('contract_billings', function (Blueprint $table) {
            $table->boolean('overtime_eligible')->after('base_salary');
            $table->string('sow')->nullable()->after('project_type');
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
            //
        });
    }
}
