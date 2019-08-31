@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Order</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('orders.store') }}">
                            @csrf
                            <input name="shopping_cart_id" type="hidden" value="{{ $shoppingCart->id }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="receiver_name">Receiver Name</label>
                                    <input name="receiver_name" type="text" class="form-control" id="receiver_name" placeholder="Receiver Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input name="email" type="email" class="form-control" id="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <input name="address" type="text" class="form-control" id="address" placeholder="1234 Main St">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="city">City</label>
                                    <input name="city" type="text" class="form-control" id="city" placeholder="Santiago de Cali">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-shopping-bag"></i> Process purchase
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

