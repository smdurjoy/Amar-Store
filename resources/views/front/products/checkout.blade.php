<?php use App\Product; ?>
@extends('layouts.front.front')

@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
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

        <table class="table table-bordered">
            <tbody>
            <tr><td><strong>DELIVERY ADDRESSES</strong> <span style="float:right"><a href="{{ url('/add-edit-delivery-address') }}" title="Add New Address"><span class="btn btn-mini btn-primary">Add New</span></a></span></td></tr>
            @foreach($deliveryAddresses as $address)
            <tr>
                <td>
                    <div class="control-group" style="float:left; margin-top:-2px; margin-right:5px;">
                        <input type="radio" id="address{{ $address['id'] }}" name="address_id" value="{{ $address['id'] }}" required>
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
                    <th>Size/Code</th>
                    <th>quantity</th>
                    <th>Unit Price</th>
                    <th>Discount</th>
                    <th>Sub Total</th>
                </tr>
            </thead>

            <tbody>
                <?php $totalPrice = 0;?>
                @foreach($userCartItems as $item)
                <?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']);?>
                    <tr>
                        <td> <img width="60" src="{{ asset('images/productImages/small/'.$item['product']['product_image']) }}" alt=""/></td>
                        <td>{{ $item['product']['product_name'] }}<br/>Color : {{ $item['product']['product_color'] }}</td>
                        <td>{{ $item['size'] }}<br/>Code : {{ $item['product']['product_code'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>Tk.{{ $attrPrice['product_price'] }}</td> 
                        <td>Tk.{{ $attrPrice['discount'] }}</td>
                        <td>Tk.{{ $attrPrice['final_price'] * $item['quantity'] }}</td>
                    </tr>
                    <?php $totalPrice += ($attrPrice['final_price'] * $item['quantity'])?>
                @endforeach

                <tr>
                    <td colspan="6" style="text-align:right">Total Price: </td>
                    <td> Tk.{{ $totalPrice }}</td>
                </tr>
                <tr>
                    <td colspan="6" style="text-align:right">Coupon Discount: </td>
                    <td class="couponAmount">
                        @if(Session::has('couponAmount'))
                            Tk.{{ Session::get('couponAmount') }}
                        @else
                            Tk.0
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="text-align:right"><strong>GRAND TOTAL</strong></td>
                    <td class="label label-important grandTotal" style="display:block"> <strong> Tk.{{ $totalPrice - Session::get('couponAmount') }} </strong></td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered">
            <tbody>
            <tr>
                <td>
                    <form id="applyCoupon" class="form-horizontal" @if(Auth::check()) user="1" @endif)>@csrf
                        <div class="control-group">
                            <label class="control-label"><strong> PAYMENT METHODS: </strong> </label>
                            <div class="controls"></div>
                        </div>
                    </form> 
                </td>
            </tr>

            </tbody>
        </table>

        <a href="{{ url('/cart') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Back to Cart </a>
        <a href="{{ url('/checkout') }}" class="btn btn-large pull-right">Place Order <i class="icon-arrow-right"></i></a>
    </div>
@endsection
