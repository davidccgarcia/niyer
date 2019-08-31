<?php

namespace App\Providers;

use App\{Order, ShoppingCart};
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

            $order = Order::where('shopping_cart_id', $sessionID)->get();

            if ($order->isEmpty()) {
                $view->with('shoppingCart', $shoppingCart);
            } else {
                session()->forget('shopping_cart');
                $view->with('shoppingCart', new ShoppingCart);
            }
        });
    }
}
