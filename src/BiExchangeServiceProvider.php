<?php

namespace AndreRacodex\BiExchange;

use AndreRacodex\BiExchange\Console\Commands\FetchExchange;
use Illuminate\Support\ServiceProvider;

class BiExchangeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchExchange::class,
            ]);

            // Publishing the migration with a dynamic timestamp
            $this->publishes([
                base_path('vendor/andreracodex/bi-exchange/database/migrations') => database_path('migrations'),
            ], 'migrations');            
        }
    }

    public function register()
    {
        //
    }
}