<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermanentPlacementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permanent_placements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('customer_name');
            $table->string('ap_contact');
            $table->string('ap_email');
            $table->string('ap_phone');
            $table->string('customer_po')->nullable();
            $table->enum('customer_status', ['new', 'existing']);
            $table->text('bill_address');
            $table->string('placement_name');
            $table->string('placement_email');
            $table->string('placement_phone');
            $table->string('position');
            $table->string('salary');
            $table->string('perm_fee');
            $table->string('total_fee');
            $table->date('start_date');
            $table->string('recruiter');
            $table->string('sales_rep');
            $table->text('special_notes');
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
        Schema::dropIfExists('permanent_placements');
    }
}
