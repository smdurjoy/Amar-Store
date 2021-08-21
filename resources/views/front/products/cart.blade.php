@extends('layouts.front.front')

@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active"> Shopping Cart</li>
                </ul>
            </div>
        </div>
    </div>
    <!--Shopping Cart Area Strat-->
    <div class="Shopping-cart-area pt-60 pb-60">
        <div class="container">
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
            <div class="row">
                @if(!empty($userCartItems))
                <div class="col-12">
                    <div class="table-content table-responsive" id="appendCartItems">
                        @include('front.products.cartItems')
                    </div>
                    <form id="applyCoupon" class="form-horizontal" @if(Auth::check()) user="1" @endif)>@csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="coupon-all">
                                    <div class="coupon">
                                        <input class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text" id="couponCode" required>
                                        <input class="button" value="Apply coupon" type="submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-12">
                    <a href="{{ url('/checkout') }}" class="btn common-btn pull-right">Checkout <i class="icon-arrow-right"></i></a>
                </div>
                @else
                <div class="col-12">
                    <div align="center">
                        <h3>YOUR CART IS EMPTY 😒 !</h3>
                        <a href="{{ url('/') }}" class="btn common-btn">Shop Now</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!--Shopping Cart Area End-->
@endsection	