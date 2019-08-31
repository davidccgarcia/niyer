@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Order Created</h1>
        <hr>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Name: </strong> {{ $order->receiver_name }}
                    </div>
                    <div class="col-md-6">
                        <strong>Email: </strong> {{ $order->email }}
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <strong>Address: </strong> {{ $order->address }}
                    </div>
                    <div class="col-md-6">
                        <strong>City: </strong> {{ $order->city }}
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <strong>Status: </strong> {{ $order->status }}
                    </div>
                    <div class="col-md-6">
                        <strong>Guide Number: </strong> {{ $order->guide_number }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
