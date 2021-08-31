@extends('layouts.front.front')

@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active"> success</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="content-wraper pt-60 pb-60 pt-sm-30">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div align="center">
                        <h3>{{ $message }}</h3>
                        @if($status)
                            <h5>Your order process is completed. You can track your order to see the order status in your account page.</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<?php
Session::forget('transaction');
?>
