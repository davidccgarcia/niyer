@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $product->name }}</h1>
        <hr>

        <div class="row">
            <div class="col-md-4 col-xs-12">
                <img src="{{ asset($product->photo) }}" width="400" height="400" alt="Product Image" class="img-thumbnail">
            </div>
            <div class="col-md-4 col-xs-12">
                <p class="lead">{{ $product->description }}</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <p class="lead"><strong>Price: </strong>$ {{ number_format($product->price, 3) }}</p>
                <form action="{{ route('shopping_carts.store') }}" method="POST">
                    @csrf
                    <input name="product_id" type="hidden" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-success text-white btn-block">
                        <i class="fa fa-shopping-cart"></i> Add to cart
                    </button>
                </form>
            </div>

        </div>
    </div>
@endsection
