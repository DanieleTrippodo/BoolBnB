<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Braintree\Gateway;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(){

        $this->app->singleton(Gateway::class, function($app){

            return new Gateway([
                    'environment' => 'sandbox',
                    'merchantId' => 'x366f6kbj7y2cssn',
                    'publicKey' => 'hg89py57xtnbnd7z',
                    'privateKey' => '1b85d75d5134f0fdbb7cdf61a5329cf1'
                ]
            );
        });
    }
}
