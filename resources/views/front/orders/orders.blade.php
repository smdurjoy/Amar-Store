@extends('layouts.front.front')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Orders</li>
    </ul>
	<h3>Your Orders</h3>	
	<hr class="soft"/>

	<div class="row">
		<div class="span8">
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
                            <td><a href="{{ url('orders/'.$order['id']) }}" title="Order Details"><span class="btn btn-mini btn-primary">View Details</span></a></td>
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
@endsection