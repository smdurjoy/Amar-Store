<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr><td><img src="{{ asset('images/frontImages/logo-email.png') }}"/></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>Dear <strong>{{ $name }}</strong>,</td>
        </tr>
        <tr>
            <td>Your order #{{ $order_id }} status has been updated to '{{ $order_status }}'. 
            @if(!empty($courier_name) && !empty($tracking_number))
                Courier name is {{ $courier_name }} and Tracking number is {{ $tracking_number }}.
            @endif
            Order details are as below :</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                <table cellpadding="5" cellspacing="5" bgcolor="#f7f4f4">
                    <tr bgcolor="#cccccc">
                        <td>Product Name</td>
                        <td>Code</td>
                        <td>Size</td>
                        <td>Color</td>
                        <td>Quantity</td>
                        <td>Price</td>
                    </tr>
                    @foreach($orderDetails['order_products'] as $order)
                        <tr>
                            <td>{{ $order->product_name }}</td>
                            <td>{{ $order->product_code }}</td>
                            <td>{{ $order->product_size }}</td>
                            <td>{{ $order->product_color }}</td>
                            <td>{{ $order->product_qty }}</td>
                            <td>Tk {{ $order->product_price }}</td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: right;">Shipping Charges:</td>
                            <td>Tk {{ $orderDetails->shipping_charges }}</td>
                        </tr>
                        @if($orderDetails->coupon_amount > 0)
                            <tr>
                                <td colspan="5" style="text-align: right;">Coupon Discount:</td>
                                <td>Tk {{ $orderDetails->coupon_amount }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td colspan="5" style="text-align: right;">Grand Total:</td>
                            <td>Tk {{ $orderDetails->grand_total }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                <table>
                    <tr><td><strong>Delivery Address: </strong></td></tr>
                    <tr><td>{{ $orderDetails->name }}</td></tr>
                    <tr><td>{{ $orderDetails->email }}</td></tr>
                    <tr><td>{{ $orderDetails->mobile }}</td></tr>
                    <tr><td>{{ $orderDetails->address }}</td></tr>
                    <tr><td>{{ $orderDetails->city }}</td></tr>
                    @if(!empty($orderDetails->state))
                        <tr><td>{{ $orderDetails->state }}</td></tr>
                    @endif
                    @if(!empty($orderDetails->pincode))
                        <tr><td>{{ $orderDetails->pincode }}</td></tr>
                    @endif
                    @if(!empty($orderDetails->country))
                        <tr><td>{{ $orderDetails->country }}</td></tr>
                    @endif
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                For any enquiries, you can contact us at: <a href="mailto:amarstore.info@gmail.com">amarstore.info@gmail.com</a>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>Thanks, Stay Safe :)</td>
        </tr>
        <tr>
            <td><strong>Amar Store</strong></td>
        </tr>
    </table>
</body>
</html>