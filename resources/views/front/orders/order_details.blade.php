@extends('layouts.front.front')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
		<li><a href="{{ url('/orders') }}">Orders</a></li>
    </ul>
	<h3>Order #{{ $order->id }} Details</h3>	
	<hr class="soft"/>

    <div class="row">
		<div class="span4">
            <table class="table table-striped table-bordered">
                <tr>
                    <td colspan="2"><strong>Order Details</strong></td>
                </tr>
                <tr>
                    <td>Order Date</td>
                    <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                </tr>
                <tr>
                    <td>Order Status</td>
                    <td>{{ $order->order_status }}</td>
                </tr>
                <tr>
                    <td>Total Amount</td>
                    <td>{{ $order->grand_total }}</td>
                </tr>
                <tr>
                    <td>Shipping Charges</td>
                    <td>{{ $order->shipping_charges }}</td>
                </tr>
                @if($order->coupon_amount > 0)
                    <tr>
                        <td>Coupon Code</td>
                        <td>{{ $order->coupon_code }}</td>
                    </tr>
                    <tr>
                        <td>Coupon Amount</td>
                        <td>{{ $order->coupon_amount }}</td>
                    </tr>
                @endif
                <tr>
                    <td>Payment Method</td>
                    <td>{{ $order->payment_method }}</td>
                </tr>
            </table>
        </div>
		<div class="span4">
            <table class="table table-striped table-bordered">
                <tr>
                    <td colspan="2"><strong>Delivery Informations</strong></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $order->name }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $order->address }}</td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>{{ $order->city }}</td>
                </tr>
                @if(!empty($order->state))
                    <tr>
                        <td>State</td>
                        <td>{{ $order->state }}</td>
                    </tr>
                @endif
                @if(!empty($order->pincode))
                    <tr>
                        <td>Pincode</td>
                        <td>{{ $order->pincode }}</td>
                    </tr>
                @endif
                @if(!empty($order->country))
                    <tr>
                        <td>Country</td>
                        <td>{{ $order->country }}</td>
                    </tr>
                @endif
                <tr>
                    <td>Mobile</td>
                    <td>{{ $order->mobile }}</td>
                </tr>
            </table>
        </div>
    </div>

	<div class="row">
		<div class="span8">
            <table class="table table-striped table-bordered">
                <thead>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Product Size</th>
                    <th>Product Color</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                </thead>
                <tbody>
                    @foreach($order->order_products as $product)
                        <tr>
                            <td>{{ $product['product_code'] }}</td>
                            <td>{{ $product['product_name'] }}</td>
                            <td>{{ $product['product_size'] }}</td>
                            <td>{{ $product['product_color'] }}</td>
                            <td>Tk.{{ $product['product_price'] }}</td>
                            <td>{{ $product['product_qty'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
		</div>
	</div>	
</div>
@endsection