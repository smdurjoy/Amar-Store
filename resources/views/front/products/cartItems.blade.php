<?php use App\Product; ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Product</th>
            <th>Description</th>
            <th>Size/Code</th>
            <th>Quantity/Update</th>
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
                <td>
                    <div class="input-append"><input class="span1" style="max-width:34px" value="{{ $item['quantity'] }}" id="appendedInputButtons" size="16" type="text"><button class="btn cartItemUpdate qtyMinus" type="button" data-id="{{ $item['id'] }}"><i class="icon-minus"></i></button><button class="btn cartItemUpdate qtyPlus" type="button" data-id="{{ $item['id'] }}"><i class="icon-plus"></i></button><button class="btn btn-danger cartItemDelete" data-id="{{ $item['id'] }}" type="button"><i class="icon-remove icon-white"></i></button>	</div>
                </td>
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