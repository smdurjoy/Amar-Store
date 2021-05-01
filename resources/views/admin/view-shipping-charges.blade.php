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
                            <li class="breadcrumb-item active"><a>Shipping Charges</a></li>
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
                                <h3 class="card-title">Shipping Charges</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="shippingChargeTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-bold">SL</th>
                                        <th class="text-bold">Country</th>
                                        <th class="text-bold">Shipping Charge</th>
                                        <th class="text-bold">Status</th>
                                        <th class="text-bold">Updated at</th>
                                        <th class="text-bold">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shipping_charges as $key => $shipping)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $shipping->country }}</td>
                                            <td>{{ $shipping->shipping_charge }}</td>
                                            <td>
                                                @if($shipping->status == 1)
                                                    <a class="updateStatus" record="shipping" href="javascript:void(0)" record_id="{{ $shipping->id  }}"> <span id="shipping-{{$shipping->id}}" class="badge badge-primary">Active</span> </a>
                                                @else
                                                    <a class="updateStatus" record="shipping" href="javascript:void(0)" record_id="{{ $shipping->id  }}"> <span id="shipping-{{$shipping->id}}" class="badge badge-primary">Inactive</span> </a>
                                                @endif
                                            </td>
                                            <td>{{ date("F j, Y", strtotime($shipping->created_at)) }} at {{ date("g:i a", strtotime($shipping->created_at)) }}</td>
                                            <td>
                                                <a class="btn btn-primary deleteBtn" title="Edit Shipping Charge" href="{{ url('admin/edit-shipping-charge/'.$shipping->id) }}"><i class="fas fa-edit"></i></a>
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


