<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\EmailConfiguration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class MailConfigProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        if (\Schema::hasTable('email_configurations')) {
            $mail = \DB::table('email_configurations')->first();
            if ($mail) { //checking if table is not empty
                    $config = array(
                        'driver'     =>     $mail->driver,
                        'host'       =>     $mail->host,
                        'port'       =>     $mail->port,
                        'username'   =>     $mail->user_name,
                        'password'   =>     $mail->password,
                        'encryption' =>     $mail->encryption,
                        'from'       =>     array('address' => $mail->sender_email, 'name' => $mail->sender_name),
                    );
                    Config::set('mail', $config);
            }
        }
       
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
