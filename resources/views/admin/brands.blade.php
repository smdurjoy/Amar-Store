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
                                <li class="breadcrumb-item active"><a href=" {{url('/admin/brands')}} ">Brands</a></li>
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
                                    <h3 class="card-title">Brands</h3>
                                    <a href="{{ url('admin/add-edit-brand ') }}" class="btn btn-dark addButton" style="float: right">Add Brands</a>
                            </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="sectionTable" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($brands as $brand)
                                            <tr>
                                                <td>{{ $brand->id  }}</td>
                                                <td>{{ $brand->name  }}</td>
                                                <td>
                                                    @if($brand->status == 1)
                                                        <a class="updateStatus" record="brand" href="javascript:void(0)" record_id="{{ $brand->id  }}"> <span id="brand-{{$brand->id}}" class="badge badge-primary">Active</span> </a>
                                                    @else
                                                        <a class="updateStatus" record="brand" href="javascript:void(0)" record_id="{{ $brand->id  }}"> <span id="brand-{{$brand->id}}" class="badge badge-primary">Inactive</span> </a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                <div class="brandActions">
                                                    <a title="Edit Brand" href="{{ url('admin/add-edit-brand/'.$brand->id) }}"><i class="fas fa-edit"></i></a>
                                                    <a title="Delete Brand" class="confirmDelete" record="brand" recordId="{{ $brand->id }}" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
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


