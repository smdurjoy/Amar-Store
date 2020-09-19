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
                            <li class="breadcrumb-item active"><a href=" {{url('/admin/categories')}} ">Categories</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        @if(Session::has('successMessage'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ Session::get('successMessage')  }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Categories</h3>
                                <a href="{{ url('admin/add-edit-category ') }}" class="btn btn-dark" style="float: right"> Add Category</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="categoryTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category</th>
                                        <th>Parent Category</th>
                                        <th>Section</th>
                                        <th>URL</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        @if(!isset($category->parentCategory->category_name))
                                            <?php $parent_category = "Root"; ?>
                                        @else
                                            <?php $parent_category = $category->parentCategory->category_name; ?>
                                        @endif
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->category_name }}</td>
                                            <td>{{ $parent_category }}</td>
                                            <td>{{ $category->section->name }}</td>
                                            <td>{{ $category->url }}</td>
                                            <td>
                                                @if($category->status == 1)
                                                    <a class="updateStatus" record="category" href="javascript:void(0)" record_id="{{ $category->id  }}"> <span id="category-{{$category->id}}" class="badge badge-primary">Active</span> </a>
                                                @else
                                                    <a class="updateStatus" record="category" href="javascript:void(0)" record_id="{{ $category->id  }}"> <span id="category-{{$category->id}}" class="badge badge-primary">Inactive</span> </a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href={{ url("admin/add-edit-category/".$category->id) }}>Edit</a>
                                                &nbsp;&nbsp;
                                                <a class="confirmDelete" record="category" recordId="{{ $category->id }}" href="javascript:void(0)" <?php /* name="Category" href="{{ url('admin/delete-category/'.$category->id) }}" */ ?>>Delete</a>
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

