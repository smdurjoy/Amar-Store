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
                            <li class="breadcrumb-item active"><a href=" {{url('/admin/updateAdminDetails')}} ">Settings</a></li>
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
                                <h3 class="card-title">Update Informations</h3>
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

                        <!-- form start -->
                            <form role="form" action="/admin/updateAdminDetails" method="post" id="adminDetailsUpdateForm" enctype="multipart/form-data">@csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Type</label>
                                        <input class="form-control" value="{{ Auth::guard('admin')->user()->type }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Name</label>
                                        <input type="text" class="form-control" value="{{ Auth::guard('admin')->user()->name }}" id="adminName" placeholder="Enter Your Name" name="adminName">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mobile</label>
                                        <input type="text" class="form-control" value="{{ Auth::guard('admin')->user()->mobile }}" id="adminMobile" placeholder="Enter mobile number" name="adminMobile" required>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-10">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Image</label>
                                                <input type="file" class="form-control" id="newPass" name="adminImage">
                                                @if(!empty(Auth::guard('admin')->user()->image))
                                                    <input type="hidden" name="adminCurrentImage" value="{{ Auth::guard('admin')->user()->image }}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col col-md-2">
                                            <img src="{{ url('images/adminPhoto/'.Auth::guard('admin')->user()->image) }}" alt="image!" class="updateImage">
                                        </div>
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

