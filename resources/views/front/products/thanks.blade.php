<?php use App\Product; ?>
@extends('layouts.front.front')

@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active"> thanks</li>
            </ul>
        </div>
    </div>
</div>
<div class="content-wraper pt-60 pb-60 pt-sm-30">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div align="center">
                <h3>YOUR ORDER HAS BEEN PLACED SUCCESSFULLY.</h3>
                <h5>Order number is #{{ Session::get('order_id') }} and total amount TK. {{ Session::get('grand_total') }}</h5>
                <a style="text-decoration:underline; font-size:16px; margin-top:10px;" href="{{ url('orders/'.Session::get('order_id')) }}">View Details</a>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

<?php
    Session::forget('grand_total');
    Session::forget('order_id');
    Session::forget('couponCode');
    Session::forget('couponAmount');
?>
