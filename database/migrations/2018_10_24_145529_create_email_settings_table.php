<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('driver');
            $table->string('host');
            $table->integer('port')->unsigned();
            $table->string('from_address');
            $table->string('from_name');
            $table->string('encryption')->default('tls');
            $table->string('username');
            $table->string('password');
            $table->string('sendmail')->default('/usr/sbin/sendmail -bs');
            $table->string('markdown_theme')->default('default');
            $table->string('markdown_paths')->default('views/vendor/mail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_settings');
    }
}
