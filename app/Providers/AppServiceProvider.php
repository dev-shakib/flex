<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        /**
         * if site is on production and not using https, force to use https
         * you can comment out this code if dont want to force your request to use https
         */
        if(env('APP_ENV') !== 'local'){
            URL::forceScheme('https');
        }

    }
}
