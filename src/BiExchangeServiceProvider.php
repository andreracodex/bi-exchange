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
                __DIR__.'/../database/migrations/create_currencies_table.php' => database_path('migrations/'.date('Y_m_d_His').'_create_currencies_table.php'),
            ], 'migrations');
        }
    }

    public function register()
    {
        //
    }
}