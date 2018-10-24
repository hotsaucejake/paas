<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EmailSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_settings')->insert([
            'driver' => 'smtp',
            'host' => 'smtp.mailtrap.io',
            'port' => 2525,
            'from_address' => 'info@corus360.com',
            'from_name' => 'PaaS',
            'encryption' => 'tls',
            'username' => 'cba2c1b2901ed5',
            'password' => '617f86d4b7e89c',
            'sendmail' => '/usr/sbin/sendmail -bs',
            'markdown_theme' => 'default',
            'markdown_paths' => 'views/vendor/mail',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
