<?php

namespace Andreracodex\BiExchange;

use Illuminate\Support\ServiceProvider;
use Andreracodex\BiExchange\Console\Commands\FetchExchange;

class FetchExchangeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            FetchExchange::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish the migrations
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'migrations');

        // Publish the Currency model
        $this->publishes([
            __DIR__.'/../../src/Models/Currency.php' => app_path('Models/Currency.php'),
        ], 'models');
    }
}
