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
                                <li class="breadcrumb-item active"><a href=" {{url('/admin/coupons')}} ">Coupons</a></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Coupons</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="couponTable" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th class="text-bold">SL</th>
                                            <th class="text-bold">Code</th>
                                            <th class="text-bold">Coupon Type</th>
                                            <th class="text-bold">Amount</th>
                                            <th class="text-bold">Expiry Date</th>
                                            <th class="text-bold">Status</th>
                                            <th class="text-bold">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($coupons as $key => $coupon)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $coupon['coupon_code'] }}</td>
                                                <td>{{ $coupon['coupon_type'] }}</td>
                                                <td>
                                                    {{ $coupon['amount'] }}
                                                    @if($coupon['amount_type'] == 'Percentage')
                                                        %
                                                    @else
                                                        Tk
                                                    @endif
                                                </td>
                                                <td>{{ $coupon['expiry_date'] }}</td>
                                                <td>
                                                    @if($coupon['status'] == 1)
                                                        <a class="updateStatus" record="coupon" href="javascript:void(0)" record_id="{{ $coupon['id']  }}"> <span id="coupon-{{$coupon['id']}}" class="badge badge-primary">Active</span> </a>
                                                    @else
                                                        <a class="updateStatus" record="coupon" href="javascript:void(0)" record_id="{{ $coupon['id']  }}"> <span id="coupon-{{$coupon['id']}}"  class="badge badge-primary">Inactive</span> </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary deleteBtn" title="Edit Coupon" href="{{ url('admin/add-edit-coupon/'.$coupon['id']) }}"><i class="fas fa-edit"></i></a>
                                                    <a title="Delete Coupon" class="btn btn-danger deleteBtn confirmDelete" record="coupon" recordId="{{ $coupon['id'] }}" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
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