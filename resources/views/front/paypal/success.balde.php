@extends('layouts.front.front')

@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
            <li class="active"> confirmed</li>
        </ul>
        <hr class="soft"/>
        
        <div align="center">
            <h3>YOUR PAYMENT HAS BEEN CONFIRMD.</h3>
            <p>Thanks for your order. Stay with us :)</p>
            <h5>Order number is {{ Session::get('order_id') }} and total amount paid is TK.{{ Session::get('grand_total') }}</h5>
            <a href="{{ url('/') }}">Continue Shopping</a> 
        </div>
    </div>
@endsection

<?php
    Session::forget('grand_total');
    Session::forget('order_id');
    Session::forget('couponCode');
    Session::forget('couponAmount');
?>