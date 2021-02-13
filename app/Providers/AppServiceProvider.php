<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema,URL;


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
        Schema::defaultStringLength(191); //VARCHAR 255 , LIMIT to 191
        URL::forceScheme(env('SECURE_ASSET',FALSE) == TRUE ? 'https' : 'http'); //standby for http or https enabling
        
    }
}
