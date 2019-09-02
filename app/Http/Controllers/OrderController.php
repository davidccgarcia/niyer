<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Order, ShoppingCart};

class OrderController extends Controller
{
    /**
     * Create a new ProductController Instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shoppingCart = ShoppingCart::find($request->shopping_cart_id);

        $order = new Order;
        $order->shopping_cart_id = $shoppingCart->id;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->receiver_name = $request->receiver_name;
        $order->email = $request->email;
        $order->guide_number = $order->guideNumber();
        $order->total = $shoppingCart->total();
        $order->save();

        $shoppingCart->discountStock();

        return redirect()
            ->route('orders.show', ['order' => $order]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show', ['order' => $order]);
    }
}
