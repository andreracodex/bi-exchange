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

            // Publish migration
            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'migrations');
        }
    }

    public function register()
    {
        //
    }
}