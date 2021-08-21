<?php use App\Product; ?>

<table class="table">
    <thead>
        <tr>
            <th class="li-product-remove">Remove</th>
            <th class="li-product-thumbnail">Image</th>
            <th class="cart-product-name">Description</th>
            <th class="li-product-price">Unit Price</th>
            <th class="li-product-quantity">Quantity</th>
            <th class="li-product-subtotal">Total</th>
            <th class="li-product-subtotal">Discount</th>
            <th class="li-product-subtotal">Sub Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $totalPrice = 0;?>
        @foreach($userCartItems as $key => $item)
            <?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']);?>
            <tr>
                <td class="li-product-remove"><a class="cartItemDelete" style="cursor:pointer" data-id="{{ $item['id'] }}" type="button">✖</a></td>
                <td class="li-product-thumbnail"><img style="width:120px; height:120px;" src="{{ asset('images/productImages/small/'.$item['product']['product_image']) }}" alt="Li's Product Image"></td>
                <td class="li-product-name">
                    <a href="#">
                    {{ $item['product']['product_name'] }}<br/>Color : {{ $item['product']['product_color'] }}<br/>Size: {{ $item['size'] }}<br/>Code : {{ $item['product']['product_code'] }}
                    </a>
                </td>
                <td class="li-product-price"><span class="amount">Tk. {{ $attrPrice['product_price'] }}</span></td>
                <td>
                    <div class="d-flex justify-content-center">
                        <input class="qtyBox qt__{{ $key }}" type="text" value="{{ $item['quantity'] }}" id="appendedInputButtons">
                        <div class="d-flex flex-column">
                            <button class="cartItemUpdate qtyBtn qtyPlus" data-index="{{ $key }}" type="button" data-id="{{ $item['id'] }}"><i class="fa fa-angle-up"></i></button>
                            <button class="cartItemUpdate qtyBtn qtyMinus" data-index="{{ $key }}" type="button" data-id="{{ $item['id'] }}"><i class="fa fa-angle-down"></i></button>
                        </div>
                    </div>
                </td>
                <td class="product-subtotal"><span class="amount">Tk. {{ $attrPrice['product_price'] * $item['quantity'] }}</span></td>
                <td class="product-subtotal"><span class="amount">Tk. {{ $attrPrice['discount'] * $item['quantity'] }}</span></td>
                <td class="li-product-price"><span class="amount">Tk. {{ $attrPrice['final_price'] * $item['quantity'] }}</span></td>
            </tr>
            <?php $totalPrice += ($attrPrice['final_price'] * $item['quantity'])?>
        @endforeach

        <tr>
            <td colspan="7" style="text-align:right; font-weight:500; font-size:15px">Total Price: </td>
            <td class="li-product-price"><span class="amount">Tk. {{ $totalPrice }}</span></td>
        </tr>
        <tr>
            <td colspan="7" style="text-align:right; font-weight:500; font-size:15px">Coupon Discount: </td>
            <td class="li-product-price couponAmount">
                @if(Session::has('couponAmount'))
                    <span class="amount">Tk. {{ Session::get('couponAmount') }}</span>
                @else
                    <span class="amount">Tk. 0</span>
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align:right; font-weight:500; font-size:15px"><strong>GRAND TOTAL </strong></td>
            <td class="li-product-price grandTotal" style="background-color: #ffdf50;"> <span class="amount"> Tk. {{ $totalPrice - Session::get('couponAmount') }}</span></td>
        </tr>
    </tbody>
</table>