@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Shopping Cart</h1>
        <hr>
        @if (! $products->isEmpty())
            <div class="row">
                <div class="col-md-8">
                    @foreach ($products as $product)
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset($product->photo) }}" class="img-thumbnail" width="200" height="200" alt="Product photo">
                            </div>
                            <div class="col-md-8">
                                <h4>{{ $product->name }}</h4>
                                <p class="lead">
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
                <div class="col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h5>Subtotal:</h5> <strong>$ {{ $shoppingCart->subtotal() }} COP</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Shipping
                            <strong>$ {{ $shoppingCart->shipping() }} COP</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Products
                            <span class="badge badge-primary badge-pill">{{ $shoppingCart->productsCount() }}</span>
                        </li>
                        <li class="list-group-item">
                            <h5 class="d-inline-block">Total:</h5> <strong class="text-right">$ {{ $shoppingCart->total() }} COP</strong>

                            <a href="#" class="btn btn-success btn-block">
                                <i class="fa fa-shopping-bag"></i> Process purchase
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @else
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center text-danger"><i class="fa fa-shopping-cart"></i></h1>
                        <h2 class="text-center text-success m-4 p-4">You have no items in your cart</h2>

                        <p class="text-center">
                            <a href="/" class="btn btn-success btn-block">Buy now</a>
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
