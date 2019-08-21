@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Add Products</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Name</label>
                                    <input name="name" type="text" class="form-control" id="name" placeholder="name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="stock">Stock</label>
                                    <input name="stock" type="number" class="form-control" id="stock" placeholder="stock">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" placeholder="Contiene ácido cítrico, glicolico y salicilico " id="description" cols="30" rows="5"></textarea>
                            </div>
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
                                    <input name="wholesale_unit_value" type="number" class="form-control" id=wholesale_unit_value">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="unit_value">Unit Value</label>
                                    <input name="unit_value" type="number" class="form-control" id="unit_value">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
