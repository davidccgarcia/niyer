<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Product, ShoppingCart};
use Illuminate\Database\Eloquent\Builder;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the shopping carts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessionID = session()->get('shopping_cart');
        $shoppingCart = ShoppingCart::findOrCreate($sessionID);
        session()->put('shopping_cart', $shoppingCart->id);

        $products = Product::whereHas('shoppingCarts', function (Builder $query) {
            $query->where('shopping_cart_id', session('shopping_cart_id'));
        })->get();

        return view('shopping_carts.index', [
            'products' => $products,
            'shoppingCart' => $shoppingCart,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sessionID = session()->get('shopping_cart');
        $shoppingCart = ShoppingCart::findOrCreate($sessionID);
        session()->put('shopping_cart', $shoppingCart->id);

        $shoppingCart->products()->attach($request->product_id);

        return redirect()
            ->route('products.show', $request->product_id);
    }
}
