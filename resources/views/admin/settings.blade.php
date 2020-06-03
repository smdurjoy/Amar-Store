@extends('layouts/admin/admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Settings</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href=" {{url('/admin/dashboard')}} ">Home</a></li>
                            <li class="breadcrumb-item active"><a href=" {{url('/admin/settings')}} ">Settings</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Password</h3>
                            </div>
                            <!-- /.card-header -->
                            @if(Session::has('errorMessage'))
                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                    {{ Session::get('errorMessage')  }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if(Session::has('successMessage'))
                                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                    {{ Session::get('successMessage')  }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <!-- form start -->
                            <form role="form" action="/admin/updateCurrentPass" method="post" id="adminUpdateForm">@csrf
                                <div class="card-body">
{{--                                    <div class="form-group">--}}
{{--                                        <label for="exampleInputPassword1">Admin Name</label>--}}
{{--                                        <input type="text" class="form-control" value="{{ $adminDetails->name  }}" id="adminName" placeholder="Admin Name" name="adminName">--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="exampleInputEmail1">Admin Email</label>--}}
{{--                                        <input class="form-control" value="{{ $adminDetails->email  }}" readonly>--}}
{{--                                    </div>--}}
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Current Password</label>
                                        <input type="password" class="form-control" id="currentPass" placeholder="Enter Current Password" name="currentPass" required>
                                        <span id="chkCurrentPass"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">New Password</label>
                                        <input type="password" class="form-control" id="newPass" name="newPass" placeholder="Enter New Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirmPass" name="confirmPass" placeholder="Enter the same as New" required>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        <section/>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

