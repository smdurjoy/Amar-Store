<?php use App\Product; ?>
@extends('layouts.front.front')

@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
            <li class="active"> checkout</li>
        </ul>
        <h3>  CHECKOUT [ <small><span class="totalCartItems">{{ totalCartItems() }}</span> Item(s) </small>]<a href="{{ url('/cart') }}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Back to Cart </a></h3>
        <hr class="soft"/>
        @if(Session::has('successMessage'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('successMessage')  }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(Session::has('errorMessage'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('errorMessage')  }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger mt-3" role="alert">
                <ul>
                    @foreach( $errors->all() as $error )
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="checkoutForm" action="{{ url('/checkout') }}" method="post">@csrf
            <table class="table table-bordered">
                <tbody>
                <tr><td><strong>DELIVERY ADDRESSES</strong> <span style="float:right"><a href="{{ url('/add-edit-delivery-address') }}" title="Add New Address"><span class="btn btn-mini btn-primary">Add New</span></a></span></td></tr>
                @foreach($deliveryAddresses as $address)
                <tr>
                    <td>
                        <div class="control-group" style="float:left; margin-top:-2px; margin-right:5px;">
                            <input type="radio" id="address{{ $address['id'] }}" name="address_id" value="{{ $address['id'] }}" shipping_charge="{{ $address['shipping_charge'] }}" total_price="{{ $totalPrice }}" coupon_amount="{{ Session::get('couponAmount') }}" required>
                        </div>
                        <div class="control-group" style="float:right;">
                            <span><a href="{{ url('/add-edit-delivery-address/'.$address['id']) }}" title="Edit Address"><span class="btn btn-mini btn-info"><i class="fas fa-edit"></i></span></a></span>
                            <span><a class="confirmDelete" href="javascript:void(0)" title="Delete Address" record="address" recordId="{{ $address['id'] }}"><span class="btn btn-mini btn-danger"><i class="fas fa-trash"></i></span></a></span>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="address{{ $address['id'] }}">{{ $address['name'] }}, {{ $address['address'] }}, {{ $address['city'] }}, {{ $address['state'] }}, {{ $address['country'] }}</label> 
                        </div>
                    </td>
                </tr>
                @endforeach 
                </tbody>
            </table>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Description</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th style="text-align:right">Sub Total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $totalPrice = 0;?>
                    @foreach($userCartItems as $item)
                    <?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']);?>
                        <tr>
                            <td> <img width="60" src="{{ asset('images/productImages/small/'.$item['product']['product_image']) }}" alt=""/></td>
                            <td>{{ $item['product']['product_name'] }}<br/>Color : {{ $item['product']['product_color'] }} <br/>{{ $item['size'] }}<br/>Code : {{ $item['product']['product_code'] }}</td>
                            <td>Tk.{{ $attrPrice['product_price'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>Tk.{{ $attrPrice['product_price'] * $item['quantity'] }}</td> 
                            <td>Tk.{{ $attrPrice['discount'] * $item['quantity'] }}</td>
                            <td style="text-align:right">Tk.{{ $attrPrice['final_price'] * $item['quantity'] }}</td>
                        </tr>
                        <?php $totalPrice += ($attrPrice['final_price'] * $item['quantity']); ?>
                    @endforeach

                    <tr>
                        <td colspan="6" style="text-align:right">Total Price: </td>
                        <td style="text-align:right"> Tk.{{ $totalPrice }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" style="text-align:right">Coupon Discount: </td>
                        <td class="couponAmount" style="text-align:right">
                            @if(Session::has('couponAmount'))
                                Tk.{{ Session::get('couponAmount') }}
                            @else
                                Tk.0
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" style="text-align:right">Shipping Charges: </td>
                        <td class="shippingCharges" style="text-align:right">Tk.0</td>
                    </tr> 
                    <tr>
                        <td colspan="6" style="text-align:right"><strong>GRAND TOTAL</strong></td>
                        <td class="label label-important grandTotal" style="display:block; text-align:right"> 
                            <strong> Tk.{{ $grand_total = $totalPrice - Session::get('couponAmount') }} </strong>
                            <?php Session::put('grand_total', $grand_total); ?>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <div class="control-group" style="display:flex">
                                <label class="control-label"><strong> PAYMENT METHODS: </strong> </label>
                                <div style="display:flex; margin-left:10px">
                                    <div style="display:flex">
                                        <input type="radio" name="payment_gateway" id="COD" value="COD" required>
                                        <label for="COD" style="margin-left:5px; cursor:pointer;"><strong>COD </strong>(Cash on delivery)</label>
                                    </div>
                                    <div style="display:flex; margin-left: 10px">
                                        <input type="radio" name="payment_gateway" id="paypal" value="paypal" required>
                                        <label for="paypal" style="margin-left:5px; cursor:pointer;"><strong>Paypal</strong></label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <a href="{{ url('/cart') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Back to Cart </a>
            <button type="submit" class="btn btn-large pull-right">Place Order <i class="icon-arrow-right"></i></button>

        </form>
    </div>
@endsection
