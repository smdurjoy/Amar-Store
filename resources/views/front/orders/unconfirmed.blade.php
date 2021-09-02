@extends('layouts.front.front')
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/orders') }}">orders</a></li>
                    <li class="active"> unconfirmed</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="content-wraper pt-60 pb-60 pt-sm-30">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="mb-4">Your Orders</h3>
                    @if(count($orders) > 0)
                        <table class="table table-striped table-bordered">
                            <thead>
                            <th>Order ID</th>
                            <th>Order Products</th>
                            <th>Payment Method</th>
                            <th>Grand Total</th>
                            <th>Created On</th>
                            <th></th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>#{{ $order['id'] }}</td>
                                    <td>
                                        @foreach($order['order_products'] as $product)
                                            {{ $product['product_code'] }} <br>
                                        @endforeach
                                    </td>
                                    <td>{{ $order['payment_method'] }}</td>
                                    <td>Tk.{{ $order['grand_total'] }}</td>
                                    <td>{{ date('d-m-Y', strtotime($order['created_at'])) }}</td>
                                    <td><a href="{{ url('orders/'.$order['id']) }}" title="Order Details"><span class="btn">View Details</span></a></td>
                                    <td>
                                        <button class="btn btn-primary" id="sslczPayBtn"
                                                token="if you have any token validation"
                                                postdata="your javascript arrays or objects which requires in backend"
                                                order="{{ $order['id'] }}"
                                                endpoint="{{ url('pay-prepaid') }}"> Pay Now
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3>Be fast to order your first product. Go to <a style="color:blue; text-decoration:underline" href="{{ url('/') }}">shopping page</a></h3>
                    @endif
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
