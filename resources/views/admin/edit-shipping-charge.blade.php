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
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('admin/edit-shipping-charge') }}">Edit Shipping Charge</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <ul>
                            @foreach( $errors->all() as $error )
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <!-- Add shipping-charge form -->
                <form method="post" action="{{ url('admin/edit-shipping-charge/'.$shipping_charge->id) }}">@csrf
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title"> Update Shipping Charge</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" name="country" id="country" value="{{ $shipping_charge->country }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="0_500g">Shipping Charge (0-500g)</label>
                                        <input type="text" class="form-control" name="0_500g" id="0_500g" placeholder="Enter Shipping Charge" value="{{ $shipping_charge['0_500g'] }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="501_1000g">Shipping Charge (501-1000g)</label>
                                        <input type="text" class="form-control" name="501_1000g" id="501_1000g" placeholder="Enter Shipping Charge" value="{{ $shipping_charge['501_1000g'] }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="1001_2000g">Shipping Charge (1001-2000g)</label>
                                        <input type="text" class="form-control" name="1001_2000g" id="1001_2000g" placeholder="Enter Shipping Charge" value="{{ $shipping_charge['1001_2000g'] }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="2001_5000g">Shipping Charge (2001-5000g)</label>
                                        <input type="text" class="form-control" name="2001_5000g" id="2001_5000g" placeholder="Enter Shipping Charge" value="{{ $shipping_charge['2001_5000g'] }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="above_5000g">Shipping Charge (Above 5000g)</label>
                                        <input type="text" class="form-control" name="above_5000g" id="above_5000g" placeholder="Enter Shipping Charge" value="{{ $shipping_charge['above_5000g'] }}">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->  
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</Button>
                            <a href="{{ url('admin/view-shipping-charges') }}" class="btn btn-dark btn-sm">Go back</a>
                        </div>
                    </div>
                    <!-- /.card -->
                </form>
                <!-- /.Add shipping-charge form -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
