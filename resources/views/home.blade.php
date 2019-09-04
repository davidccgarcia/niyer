@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Products</h1>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-xs-12 col-md-3" style="margin: 1em 0.5em;">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <img src="{{ asset($product->photo) }}" width="200" height="200" class="img-fluid mx-auto d-block" alt="Product image">
                                <hr>
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <div class="mb-1 text-danger">$ {{ $product->price() }}COP</div>
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input name="product_id" type="hidden" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-success text-white btn-block">
                                        <i class="fa fa-shopping-cart"></i> Add to cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
