<?php use App\Product; ?>
@extends('layouts/admin/admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Catalogues</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a>Order #{{ $order->id }} Details</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if(Session::has('successMessage'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        {{ Session::get('successMessage')  }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Order Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-sm table-striped">
                                    <tbody>
                                    <tr>
                                        <td class="pl-2">Order Date</td>
                                        <td>{{ date("F j, Y", strtotime($order->created_at)) }} at {{ date("g:i a", strtotime($order->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-2">Order Status</td>
                                        <td>{{ $order->order_status }}</td>
                                    </tr>
                                    @if(!empty($order->courier_name) && !empty($order->tracking_number))
                                        <tr>
                                            <td>Courier Name</td>
                                            <td>{{ $order->courier_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tracking Number</td>
                                            <td>{{ $order->tracking_number }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="pl-2">Total Amount</td>
                                        <td>Tk.{{ $order->grand_total }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-2">Shipping Charges</td>
                                        <td>Tk.{{ $order->shipping_charges }}</td>
                                    </tr>
                                    @if($order->coupon_amount > 0)
                                        <tr>
                                            <td class="pl-2">Coupon Code</td>
                                            <td>{{ $order->coupon_code }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pl-2">Coupon Amount</td>
                                            <td>Tk.{{ $order->coupon_amount }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="pl-2">Payment Method</td>
                                        <td>{{ $order->payment_method }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Customer Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-sm table-striped">
                                    <tbody>
                                    <tr>
                                        <td class="pl-2">Name</td>
                                        <td>{{ $customer->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-2">Email</td>
                                        <td>{{ $customer->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-2">Number</td>
                                        <td>{{ $customer->mobile }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Delivery Information</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-sm table-striped">
                                    <tbody>
                                    <tr>
                                        <td class="pl-2">Name</td>
                                        <td>{{ $order->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-2">Address</td>
                                        <td>{{ $order->address }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-2">City</td>
                                        <td>{{ $order->city }}</td>
                                    </tr>
                                    @if(!empty($order->state))
                                        <tr>
                                            <td class="pl-2">State</td>
                                            <td>{{ $order->state }}</td>
                                        </tr>
                                    @endif
                                    @if(!empty($order->pincode))
                                        <tr>
                                            <td class="pl-2">Pincode</td>
                                            <td>{{ $order->pincode }}</td>
                                        </tr>
                                    @endif
                                    @if(!empty($order->country))
                                        <tr>
                                            <td class="pl-2">Country</td>
                                            <td>{{ $order->country }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="pl-2">Mobile</td>
                                        <td>{{ $order->mobile }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Order Status</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-sm table-striped">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <form action="{{ url('admin/update-order-status') }}" method="post">@csrf
                                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                <select class="form-control select2" name="order_status" id="orderStatus" required>
                                                    <option value="">Select</option>
                                                    @foreach($orderStatuses as $status)
                                                        <option value="{{ $status->name }}" @if(isset($order->order_status) && $order->order_status == $status->name) selected @endif>{{ $status->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="@if(empty($order->courier_name) && empty($order->tracking_number)) d-none ctForm @endif">
                                                    <div class="d-flex mt-2">
                                                        <input class="form-control" type="text" name="courier_name" id="courierName" placeholder="Courier Name" value="{{ $order->courier_name }}"> 
                                                        <input class="form-control ml-2" type="text" name="tracking_number" id="trackingNumber" placeholder="Tracking Number" value="{{ $order->tracking_number }}">
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary btn-sm" type="submit">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tbody>
                                        @foreach($orderLogs as $log)
                                            <tr>
                                                <td colspan="2" class="px-2">
                                                    <strong class="text-bold">{{ $log['order_status'] }}</strong>
                                                    @if(date('Y') != date('Y', strtotime($log['created_at'])))
                                                        <p>{{ date('F j, Y', strtotime($log['created_at'])) }} at {{ date('g:i a', strtotime($log['created_at'])) }}</p> 
                                                    @else
                                                        <p>{{ date('F j', strtotime($log['created_at'])) }} at {{ date('g:i a', strtotime($log['created_at'])) }}</p> 
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Order Products</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Product Image</th>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Product Size</th>
                                            <th>Product Color</th>
                                            <th>Product Price</th>
                                            <th>Product Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->order_products as $product)
                                            <tr>
                                                <td>
                                                    <?php $productImage = Product::getProductImage($product['product_id']);
                                                    // echo $productImage; die;
                                                    ?>
                                                    <a target="_blank" href="{{ url('/product/'.$product['product_id'].'/'.$product['product_name']) }}"><img style="width:80px" src="{{ asset('images/productImages/small/'.$productImage) }}" alt="{{ $product['product_id'] }}"></a>
                                                </td>
                                                <td>{{ $product['product_code'] }}</td>
                                                <td>{{ $product['product_name'] }}</td>
                                                <td>{{ $product['product_size'] }}</td>
                                                <td>{{ $product['product_color'] }}</td>
                                                <td>Tk.{{ $product['product_price'] }}</td>
                                                <td>{{ $product['product_qty'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


