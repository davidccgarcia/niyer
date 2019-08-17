@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Products</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (! $products->isEmpty())
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Código</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Valor und (al por mayor)</th>
                                    <th scope="col">Valor und (Precio al público)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td scope="col">{{ $product->id }}</td>
                                        <td scope="col">{{ $product->name }}</td>
                                        <td scope="col">{{ $product->description }}</td>
                                        <td scope="col">{{ $product->wholesale_unit_value }}</td>
                                        <td scope="col">{{ $product->unit_value }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="flexbox">
                                <div class="box">
                                    <p>No hay productos.</p>
                                </div>
                                <div class="box">
                                    <a href="{{ route('products.create') }}" class="btn btn-primary">Añadir producto</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
