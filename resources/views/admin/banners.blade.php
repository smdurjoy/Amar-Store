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
                            <li class="breadcrumb-item active"><a href=" {{url('/admin/banners')}} ">Banners</a></li>
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
                                <h3 class="card-title">Banners</h3>
                                <a href="{{ url('admin/add-edit-banner ') }}" class="btn btn-dark btn-sm" style="float: right"> Add banner</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="bannerTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Link</th>
                                        <th>ALT</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($banners as $banner)
                                        <tr>
                                            <td>{{ $banner['id'] }}</td>
                                            <td>
                                                <img class="adminBannerImage" src="{{ asset('images/bannerImages/'.$banner['image']) }}"/>
                                            </td>
                                            <td>{{ $banner['title'] }}</td>
                                            <td>{{ $banner['link'] }}</td>
                                            <td>{{ $banner['alt'] }}</td>
                                            <td>
                                                @if($banner['status'] == 1)
                                                    <a class="updateStatus" record="banner" href="javascript:void(0)" record_id="{{ $banner['id']  }}"> <span id="banner-{{ $banner['id'] }}" class="badge badge-primary">Active</span> </a>
                                                @else
                                                    <a class="updateStatus" record="banner" href="javascript:void(0)" record_id="{{ $banner['id']  }}"> <span id="banner-{{ $banner['id'] }}" class="badge badge-primary">Inactive</span> </a>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-primary deleteBtn" title="Edit banner" href="{{ url('admin/add-edit-banner/'.$banner['id']) }}"><i class="fas fa-edit"></i></a>
                                                <a title="Delete Brand" class="btn btn-danger deleteBtn confirmDelete" record="banner" recordId="{{ $banner['id'] }}" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
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

