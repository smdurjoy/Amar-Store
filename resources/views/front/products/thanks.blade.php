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
                @if(Session::get('order_status') != 0)
                    <h5>Order number is #{{ Session::get('order_id') }} and total amount TK. {{ Session::get('grand_total') }}</h5>
                    <a style="text-decoration:underline; font-size:16px; margin-top:10px;" href="{{ url('orders/'.Session::get('order_id')) }}">View Details</a>
                @else
                    <h5>Order number is #{{ Session::get('order_id') }} and total payable amount TK. {{ Session::get('grand_total') }}</h5>
                    <small class="text-danger">Your order is unconfirmed until you paid as you choose prepaid option</small>
                    <button class="btn btn-primary btn-lg btn-block mt-1" id="sslczPayBtn"
                            token="if you have any token validation"
                            postdata="your javascript arrays or objects which requires in backend"
                            order="{{ Session::get('order_id') }}"
                            endpoint="{{ url('pay-prepaid') }}"> Pay Now
                    </button>
                    <span>You can pay later also by going to this link <a style="text-decoration:underline; font-size:16px;" href="{{ url('orders/unconfirmed/'.Session::get('order_id')) }}">Pay later</a> if you wish to. You can find this link by going to the <a style="text-decoration:underline; font-size:16px;" href="{{ url('orders/unconfirmed') }}">unconfirmed orders</a> page later.</span>
                @endif
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        (function (window, document) {
            let loader = function () {
                let script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>
@endsection

<?php
    Session::forget('grand_total');
    Session::forget('order_id');
    Session::forget('couponCode');
    Session::forget('couponAmount');
?>
