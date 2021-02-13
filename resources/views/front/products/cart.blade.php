@extends('layouts.front.front')

@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>   
            <li class="active"> SHOPPING CART</li>
        </ul>
        <h3>  SHOPPING CART [ <small><span class="totalCartItems">{{ totalCartItems() }}</span> Item(s) </small>]<a href="{{ url('/') }}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>
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

        <div id="appendCartItems">
            @include('front.products.cartItems')
        </div>

        <table class="table table-bordered">
            <tbody>
            <tr>
                <td>
                    <form id="applyCoupon" class="form-horizontal" @if(Auth::check()) user="1" @endif)>@csrf
                        <div class="control-group">
                            <label class="control-label"><strong> COUPON CODE: </strong> </label>
                            <div class="controls">
                                <input type="text" class="input-medium" placeholder="Enter Coupon Code" id="couponCode" required>
                                <button type="submit" class="btn"> APPLY </button>
                            </div>
                        </div>
                        <label style="margin-left:40px">Use <span style="color:blue"><strong>offer10</strong></span> coupon for 10% discount in selected categories.</label>
                    </form> 
                </td>
            </tr>

            </tbody>
        </table>
        <a href="{{ url('/') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
        <a href="{{ url('/checkout') }}" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
    </div>
@endsection	