<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class SystemServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (\Schema::hasTable('settings')) {

            $setting = Setting::first();
            if($setting) {
                 /**
                 *  Redirect http to htps
                 */
                if (config('app.env') === 'production') {
                    URL::forceSchema('https');
                }
                 /**
                 * Override Default Config
                 */
                Config::set('app.name', $setting->site_name);
                Config::set('app.url', $setting->site_url);

                /**
                 * Mail Configuration
                 */
                $this->app['config']['mail'] = [
                    'driver'        => $setting->mail_driver,
                    'host'          => $setting->mail_host,
                    'port'          => $setting->mail_port,
                    'username'      => $setting->mail_username,
                    'password'      => $setting->mail_password,
                    'from'          => [
                    'address'   => $setting->mail_from,
                    'name'      => $setting->site_name,
                ],
                'encryption'    => $setting->mail_encryption,
            ];

            }
        }
    }
}
