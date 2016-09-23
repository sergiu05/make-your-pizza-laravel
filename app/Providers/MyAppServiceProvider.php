<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MyAppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
        	'App\Repositories\IngredientRepository',
        	'App\Repositories\EloquentIngredientRepository'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
