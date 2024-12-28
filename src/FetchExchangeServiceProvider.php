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
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'migrations');


        $this->publishes([
            __DIR__ . '/../stubs/Currency.stub' => app_path('Models/Currency.php'),
        ], 'currency-model');
    }
}
