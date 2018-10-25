<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_billings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('first_name');
            $table->string('mi')->nullable();
            $table->string('last_name');
            $table->string('consultant_company')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->string('client_name');
            $table->string('job_title');
            $table->text('job_location');
            $table->enum('environment', ['onsite', 'remote', 'both']);
            $table->enum('hire_type', ['w2', '1099', 'corp to corp']);
            $table->string('contract_rate');
            $table->string('bill_rate');
            $table->string('base_salary')->nullable();
            $table->enum('project_type', ['aug', 'sow']);
            $table->enum('issued_hardware', ['corus360', 'client', 'none']);
            $table->boolean('corus_email')->default(0);
            $table->enum('background_check', ['yes', 'no', 'completed']);
            $table->boolean('travel_reporting')->default(0);
            $table->date('start_date');
            $table->string('contract_period');
            $table->enum('drug_test', ['no', 'p5', 'p9', 'p10', 'p11', 'other']);
            $table->boolean('benefits')->default(0);
            $table->string('client_contact');
            $table->string('manager');
            $table->string('manager_email');
            $table->string('manager_phone')->nullable();
            $table->string('recruiter');
            $table->string('account_manager');
            $table->text('notes')->nullable();
            $table->boolean('approved')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_billings');
    }
}
