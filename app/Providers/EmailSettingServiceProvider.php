<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Config;
use Illuminate\Support\Facades\DB;

class EmailSettingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if(\Schema::hasTable('email_settings'))
        {
            $mail = DB::table('email_settings')->latest()->first();
            if($mail)
            {
                $config = array(
                    'driver'     => $mail->driver,
                    'host'       => $mail->host,
                    'port'       => $mail->port,
                    'from'       => array('address' => $mail->from_address, 'name' => $mail->from_name),
                    'encryption' => $mail->encryption,
                    'username'   => $mail->username,
                    'password'   => $mail->password,
                    'sendmail'   => $mail->sendmail,
                    'markdown'   => array('theme' => $mail->markdown_theme, 'paths' => array(resource_path($mail->markdown_paths))),
                );
                Config::set('mail', $config);
            }
        }
    }
}
