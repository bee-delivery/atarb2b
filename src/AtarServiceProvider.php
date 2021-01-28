<?php

namespace BeeDelivery\Atar;

use Illuminate\Support\ServiceProvider;

class AtarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/atar.php', 'atar');

        // Register the service the package provides.
        $this->app->singleton('atar', function ($app) {
            return new Atar;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/atar.php' => config_path('atar.php'),
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['atar'];
    }
}
