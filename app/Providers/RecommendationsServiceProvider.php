<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RecommendationsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
     /*
     As mentioned previously, within the register method, you should only bind things into the service container. You should never attempt to register any event listeners, routes, or any other piece of functionality within the register method. Otherwise, you may accidentally use a service that is provided by a service provider which has not loaded yet.
     */
    public function register()
    {
        //
    }
}
