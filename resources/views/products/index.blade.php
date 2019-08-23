@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach($products as $product)
                <div class="col-sm-3" style="margin-bottom: 30px;">
                    <img src="{{ asset($product->photo) }}" width="300" height="300" class="card-img-top" alt="{{ asset($product->photo) }}">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ substr($product->description, 0, 80) }}...</p>
                            <p>
                                <strong>Price: </strong>
                                <span>${{ number_format($product->unit_value, 3) }} COP</span>
                            </p>
                            <p>
                                <button type="button" class="btn btn-danger">
                                    Stock <span class="badge badge-light">{{ $product->stock }}</span>
                                </button>
                            </p>
                            <a href="#" class="btn btn-warning btn-block">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart
                            </a>
                        </div>
                    </div>
                </div><br><br>
            @endforeach
        </div>
    </div>
@endsection
