@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <h3>Orders - Statistics </h3>

                        <div class="row mt-3">
                            <div class="col-xs-4 col-md-4 col-lg-3 order-data">
                                <span>$ {{ number_format($totalMonth, 3) }}COP</span>
                                Income of the month
                            </div>
                            <div class="col-xs-4 col-md-4 col-lg-3 order-data">
                                <span>{{ $totalMonthCount }}</span>
                                Orders of the month
                            </div>
                        </div>

                        <hr>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Buyer</th>
                                    <th>Guide number</th>
                                    <th>Status</th>
                                    <th>Sale date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <th scope="col">{{ $order->id }}</th>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->city }}</td>
                                        <td>{{ $order->receiver_name }}</td>
                                        <td>{{ $order->guide_number }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                            <div class="justify-content-center">
                                {{ $orders->render() }}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
