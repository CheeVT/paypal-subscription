<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Http\Services\PayPal\HttpClient;
use App\Http\Services\PayPal\AccessToken;

class PayPalProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /*$this->app->bind(HttpClient::class, function($api) {
            return new HttpClient();
        });*/
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
