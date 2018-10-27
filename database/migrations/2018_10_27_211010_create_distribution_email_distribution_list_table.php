<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributionEmailDistributionListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribution_email_distribution_list', function (Blueprint $table) {
            $table->integer('distribution_email_id')->unsigned();
            $table->integer('distribution_list_id')->unsigned();
            
            $table->foreign('distribution_email_id', 'dist_email_id')->references('id')->on('distribution_emails');
            $table->foreign('distribution_list_id', 'dist_list_id')->references('id')->on('distribution_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distribution_email_distribution_list');
    }
}
