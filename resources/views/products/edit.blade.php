@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Edit Product</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Name</label>
                                    <input name="name" type="text" class="form-control" id="name" placeholder="name" value="{{ $product->name }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="stock">Stock</label>
                                    <input name="stock" type="number" class="form-control" id="stock" placeholder="stock" value="{{ $product->stock }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" placeholder="Describe your product" id="description" cols="30" rows="5">{{ $product->description }}</textarea>
                            </div>
                            <img class="img-thumbnail" width="200" height="200" src="/{{ $product->photo }}" alt="Product image">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Photo</span>
                                </div>
                                <div class="custom-file">
                                    <input name="photo" type="file" class="custom-file-input" id="photo">
                                    <label class="custom-file-label" for="photo">Choose file</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="wholesale_unit_value">Wholesale Unit Value</label>
                                    <input name="wholesale_unit_value" type="number" class="form-control" id=wholesale_unit_value" value="{{ number_format($product->wholesale_unit_value, 3) }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="price">Price</label>
                                    <input name="price" type="number" class="form-control" id="price" value="{{ number_format($product->price, 3) }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
