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
                            <li class="breadcrumb-item active"><a>Orders</a></li>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Orders</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="orderTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-bold">ID</th>
                                        <th class="text-bold">Date</th>
                                        <th class="text-bold">Customer Name</th>
                                        <th class="text-bold">Customer Email</th>
                                        <th class="text-bold">Product</th>
                                        <th class="text-bold">Amount</th>
                                        <th class="text-bold">Status</th>
                                        <th class="text-bold">Payment Method</th>
                                        <th class="text-bold">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $key => $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
                                            <td>{{ date('d-m-Y', strtotime($order['created_at'])) }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->email }}</td>
                                            <td>
                                                @foreach($order['order_products'] as $product)
                                                    {{ $product['product_code'] }} ({{ $product['product_qty'] }})<br>
                                                @endforeach
                                            </td>
                                            <td>{{ $order->grand_total }}</td>
                                            <td>{{ $order->order_status }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td>
                                                <div style="display:flex">
                                                    <a class="btn btn-success btn-sm" href="{{ url('admin/orders/'.$order['id']) }}" title="Order Details"><i class="fas fa-eye"></i></a> &nbsp;&nbsp;
                                                    @if($order->order_status == "Shipped" || $order->order_status == "Delivered")
                                                        <a class="btn btn-success btn-sm" target="_blank" href="{{ url('admin/view-order-invoice/'.$order['id']) }}" title="Order Invoice"><i class="fas fa-print"></i></a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


