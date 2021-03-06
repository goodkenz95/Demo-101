<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema,URL;
use App\Laravel\Services\CustomValidator;
use Illuminate\Support\Facades\Validator;

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
        Validator::resolver(function($translator, $data, $rules, $messages)
        {
            return new CustomValidator($translator, $data, $rules, $messages);
        });
    }
}
