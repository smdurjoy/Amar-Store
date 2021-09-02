@extends('layouts.front.front')
@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active"> orders</li>
            </ul>
        </div>
    </div>
</div>
<div class="content-wraper pt-60 pb-60 pt-sm-30">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-content-center mb-4">
                    <h3>Your Orders</h3>
                    <a class="btn common-btn" href="{{ url('orders/unconfirmed') }}" style="margin-top: 0; padding: 5px 10px">Unconfirmed Orders</a>
                </div>
                @if(count($orders) > 0)
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>Order ID</th>
                        <th>Order Products</th>
                        <th>Payment Method</th>
                        <th>Grand Total</th>
                        <th>Created On</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order['id'] }}</td>
                                <td>
                                    @foreach($order['order_products'] as $product)
                                        {{ $product['product_code'] }} <br>
                                    @endforeach
                                </td>
                                <td>{{ $order['payment_method'] }}</td>
                                <td>Tk.{{ $order['grand_total'] }}</td>
                                <td>{{ date('d-m-Y', strtotime($order['created_at'])) }}</td>
                                <td>
                                    <a href="{{ url('orders/'.$order['id']) }}" title="Order Details"><span class="btn">View Details</span></a> |
                                    <a href="{{ url('orders/'.$order['id'].'/track') }}" title="Track This Order"><span class="btn">Track Order</span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <h3>Be fast to order your first product. Go to <a style="color:blue; text-decoration:underline" href="{{ url('/') }}">shopping page</a></h3>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
