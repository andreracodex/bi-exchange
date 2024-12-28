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
                base_path('vendor/andreracodex/bi-exchange/src/databases/migrations') => database_path('migrations'),
            ], 'bi');         

            // Publish Models
            $this->publishes([
                base_path('vendor/andreracodex/bi-exchange/src/models') => app_path('Models'),
            ], 'bi');         
        }
    }

    public function register()
    {
        //
    }
}