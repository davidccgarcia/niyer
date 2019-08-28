@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12"><h3>Products</h3></div>
                            <div class="col-md-6 col-xs-12 text-right">
                                <a href="{{ route('products.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Add product
                                </a>
                            </div>
                        </div>

                        <hr>
                        @if (! $products->isEmpty())
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Stock</th>
                                        <th>Wholesale value</th>
                                        <th>Price</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <th scope="row">{{ $product->id }}</th>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>$ {{ number_format($product->wholesale_unit_value, 3) }}</td>
                                            <td>$ {{ number_format($product->price, 3) }}</td>
                                            <td>
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                            <td>
                                                <a class="btn btn-success" href="{{ route('products.show', $product->id) }}">
                                                    <i class="fa fa-eye"></i> View details
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No hay productos.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
