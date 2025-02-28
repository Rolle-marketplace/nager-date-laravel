<?php

namespace RolleMarketplace\NagerDateLaravel;

use Illuminate\Support\ServiceProvider;
use RolleMarketplace\NagerDateLaravel\NagerDate;

class NagerDateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/nager-date.php' => config_path('nager-date.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/nager-date.php', 'nager-date'
        );

        $this->app->singleton(NagerDate::class, function ($app) {
            return new NagerDate(
                $app['config']['nager-date.base_url']
            );
        });

        $this->app->alias(NagerDate::class, 'nager-date');
    }
}