<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Cart;
use App\Services\OnlyOneCrustIngredient;
use App\Services\CartInterface;

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
        	'App\Repositories\IngredientRepositoryInterface',
        	'App\Repositories\EloquentIngredientRepository'
        );

        /* bind validation rules for the cart class */
        $this->app->singleton(Cart::class, function($app) {
        	return new Cart(
        		array(
        			$app->make(OnlyOneCrustIngredient::class)
        		)
        	);
        });

        $this->app->bind(
        	CartInterface::class,
        	Cart::class
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
