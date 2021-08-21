<?php use App\Product; ?>
@extends('layouts.front.front')

@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Checkout</li>
                </ul>
            </div>
        </div>  
    </div>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content d-flex justify-content-between">
                <h5>CHECKOUT [ <small><span class="totalCartItems">{{ totalCartItems() }}</span> Item(s) </small>]</h5>
                <a class="bbtn" href="{{ url('/cart') }}"> <i class="fas fa-arrow-left mr-1"></i> Back to Cart</a>
            </div>
        </div>
    </div>
    <div class="container mt-4">
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
    </div>
    <form id="checkoutForm" action="{{ url('/checkout') }}" method="post">@csrf 
        <div class="Shopping-cart-area pt-10 pb-40">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><strong>DELIVERY ADDRESSES</strong><span style="float:right;"><a class="addressBtn" href="{{ url('/add-edit-delivery-address') }}" title="Add New Address"><span class="btn"><i class="fas fa-plus"></i></span></a></span></td>
                                </tr>
                                @foreach($deliveryAddresses as $address)
                                <tr>
                                    <td>
                                        <div class="filter-sub-area d-flex justify-content-between">
                                            <div class="categori-checkbox">
                                                <ul>
                                                    <li>
                                                        <input type="radio" id="address{{ $address['id'] }}" name="address_id" value="{{ $address['id'] }}" shipping_charge="{{ $address['shipping_charge'] }}" total_price="{{ $totalPrice }}" coupon_amount="{{ Session::get('couponAmount') }}" required>
                                                        <label class="control-label" for="address{{ $address['id'] }}">{{ $address['name'] }}, {{ $address['address'] }}, {{ $address['city'] }}, {{ $address['state'] }}, {{ $address['country'] }}</label> 
                                                    </li>
                                                </ul>
                                            </div>
                                            <div>   
                                                <span><a href="{{ url('/add-edit-delivery-address/'.$address['id']) }}" title="Edit Address"><span class="btn"><i class="fas fa-edit"></i></span></a></span>
                                                <span><a class="confirmDelete" href="javascript:void(0)" title="Delete Address" record="address" recordId="{{ $address['id'] }}"><span class="btn"><i class="fas fa-trash"></i></span></a></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Image</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Unit Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Discount</th>
                                <th class="text-center">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $totalPrice = 0;?>
                            @foreach($userCartItems as $item)
                            <?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']);?>
                                <tr>
                                    <td class="text-center"><img style="width:120px; height:120px;" src="{{ asset('images/productImages/small/'.$item['product']['product_image']) }}" alt="Li's Product Image"></td>
                                    <td class="li-product-name">
                                        <a href="#">
                                        {{ $item['product']['product_name'] }}<br/>Color : {{ $item['product']['product_color'] }}<br/>Size: {{ $item['size'] }}<br/>Code : {{ $item['product']['product_code'] }}
                                        </a>
                                    </td>
                                    <td class="text-center"><p>Tk. {{ $attrPrice['product_price'] }}</p></td>
                                    <td class="text-center"><p>{{ $item['quantity'] }}</p></td>
                                    <td class="text-center"><p>Tk. {{ $attrPrice['product_price'] * $item['quantity'] }}</p></td>
                                    <td class="text-center"><p>Tk. {{ $attrPrice['discount'] * $item['quantity'] }}</p></td>
                                    <td class="text-center"><strong>Tk. {{ $attrPrice['final_price'] * $item['quantity'] }}</strong></td>
                                </tr>
                                <?php $totalPrice += ($attrPrice['final_price'] * $item['quantity'])?>
                            @endforeach

                            <tr>
                                <td colspan="6" style="text-align:right; font-weight:500; font-size:15px">Total Price: </td>
                                <td class="text-center"><strong class="amount">Tk. {{ $totalPrice }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align:right; font-weight:500; font-size:15px">Coupon Discount: </td>
                                <td class="text-center couponAmount">
                                    @if(Session::has('couponAmount'))
                                        <strong>Tk. {{ Session::get('couponAmount') }}</strong>
                                    @else
                                        <strong>Tk. 0</strong>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align:right; font-weight:500; font-size:15px"><strong>GRAND TOTAL </strong></td>
                                <td class="text-center grandTotal" style="background-color: #ffdf50;"> <strong> Tk. {{ $grand_total = $totalPrice - Session::get('couponAmount') }}</strong></td>
                                <?php Session::put('grand_total', $grand_total); ?>
                            </tr>
                        </tbody>
                    </table>    

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="filter-sub-area d-flex justify-content-between">
                                        <div class="categori-checkbox">
                                            <ul class="d-flex align-items-center"> 
                                                <label class="mr-4"><strong> PAYMENT METHODS: </strong> </label>
                                                <li>
                                                    <input type="radio" name="payment_gateway" id="COD" value="COD" required>
                                                    <label for="COD" style="margin-left:5px; cursor:pointer;"><strong>COD </strong>(Cash on delivery)</label>
                                                </li>
                                                <li class="ml-4">
                                                    <input type="radio" name="payment_gateway" id="paypal" value="paypal" required>
                                                    <label for="paypal" style="margin-left:5px; cursor:pointer;"><strong>Paypal</strong></label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button class="btn common-btn pull-right" style="margin-bottom:3rem;" type="submit">Place order <i class="fas fa-arrow-right ml-1"></i></button>
                </div>
            </div>
        </div>
    </form>
@endsection	