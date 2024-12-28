<?php

namespace Andreracodex\BiExchange;

use Illuminate\Support\ServiceProvider;

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
            Console\Commands\FetchExchange::class,
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
            __DIR__ . '/../Database/Migrations/create_currencies_table.php' => database_path('migrations/' . date('Y_m_d_His') . '_create_currencies_table.php'),
        ], 'migrations');
    }
}
