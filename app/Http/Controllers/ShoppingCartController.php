<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Product, ShoppingCart};

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

        $products = Product::with(['shoppingCarts' => function ($query) use ($sessionID) {
            $query->where('shopping_cart_id', $sessionID);
        }])->get();

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
