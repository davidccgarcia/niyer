<?php

namespace App\Providers;

use App\ShoppingCart;
use Illuminate\Support\ServiceProvider;

class ShoppingCartProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $sessionID = session()->get('shopping_cart');
            $shoppingCart = ShoppingCart::findOrCreate($sessionID);
            session()->put('shopping_cart', $shoppingCart->id);

            $view->with('shoppingCart', $shoppingCart);
        });
    }
}
