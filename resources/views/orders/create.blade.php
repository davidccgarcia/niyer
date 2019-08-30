@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sale</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('sales.store') }}">
                            {{ csrf_field() }}

                            <h5>Productos</h5>

                            @foreach ($products as $product)
                                <div class="form-check form-check-inline">
                                    <input name="products[{{ $product->id }}]"
                                           class="form-check-input"
                                           type="checkbox" id="product_{{ $product->id }}"
                                           value="{{ $product->id }}"
                                        {{ old("products.{$product->id}") ? 'checked' : ''}}
                                    >
                                    <label class="form-check-label" for="product_{{ $product->id }}">{{ $product->name }}</label>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="quantity_{{ $product->id }}">Quantity</label>
                                    <input type="number" class="form-control" name="quantity_{{ $product->id }}" id="quantity_{{ $product->id }}" value="{{ old('quantity') }}">
                                </div>
                            @endforeach
                            <div class="form-group">
                                <label for="observation">Observation</label>
                                <textarea name="observation" class="form-control" placeholder="Coloque aqui una observación si es necesario..." id="observation" cols="30" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Sale</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

