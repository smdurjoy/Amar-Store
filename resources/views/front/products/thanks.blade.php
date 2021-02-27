<?php use App\Product; ?>
@extends('layouts.front.front')

@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
            <li class="active"> thanks</li>
        </ul>
        <hr class="soft"/>
        
        <div align="center">
            <h3>YOUR ORDER HAS BEEN PLACED SUCCESSFULLY.</h3>
            <h5>Order number is {{ Session::get('order_id') }} and total amount TK.{{ Session::get('grand_total') }}</h5>
        </div>
    </div>
@endsection

<?php
    Session::forget('grand_total');
    Session::forget('order_id');
?>