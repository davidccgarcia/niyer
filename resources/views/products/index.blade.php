@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Products</div>
                    <div class="card-body">
                        @if (! $products->isEmpty())
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Stock</th>
                                    <th>Wholesale value</th>
                                    <th>Price</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <th scope="row">{{ $product->id }}</th>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ substr($product->description, 0, 50)  }}...</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>$ {{ number_format($product->wholesale_unit_value, 3) }}</td>
                                        <td>$ {{ number_format($product->price, 3) }}</td>
                                        <td>Acciones</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No hay productos.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
