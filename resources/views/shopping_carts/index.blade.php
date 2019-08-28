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
        @endif
    </div>
@endsection
