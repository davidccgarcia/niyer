<?php

namespace App\Http\Controllers;

use App\{Product, Sale, SaleDetail};
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sales.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $products = Product::whereIn('id', $request->products)->get();

        $total = 0;

        foreach ($products as $key => $product) {
            $quantity = "quantity_{$request->products[$key]}";
            $total = $total + ($product->unit_value * $request->$quantity);
            $product->stock = $product->stock - $request->$quantity;
            $product->save();
        }

        $sale = new Sale;
        $sale->total = $total;
        $sale->observation = $request->observation;
        $sale->save();

        foreach ($request->products as $key => $product) {
            $quantity = "quantity_{$request->products[$key]}";

            SaleDetail::create([
                'sale_id' => $sale->id,
                'product_id' => $product,
                'quantity' => $request->$quantity,
            ]);
        }

        return redirect()
            ->route('sales');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
