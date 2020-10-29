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
                            <li class="breadcrumb-item active"><a href=" {{url('/admin/products')}} ">Products</a></li>
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
                                <h3 class="card-title">Products</h3>
                                <a href="{{ url('admin/add-edit-product') }}" class="btn btn-dark btn-sm" style="float: right"> Add Products</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="productTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Product Colour</th>
                                        <th>Product Image</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>Section</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $key => $product)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->product_code }}</td>
                                            <td>{{ $product->product_color }}</td>
                                            <td>
                                                <?php $imgPath = "images/productImages/small/".$product->product_image; ?>
                                                @if(!empty($product->product_image) && file_exists($imgPath))
                                                    <img class="productImage" src="{{ asset('images/productImages/small/'.$product->product_image)  }}">
                                                @else
                                                    <img class="productImage" src="{{ asset('images/productImages/small/smallDummyImg.png') }}">
                                                @endif
                                            </td>
                                            <td>{{ $product->brand['name'] }}</td>
                                            <td>{{ $product->category->category_name }}</td>
                                            <td>{{ $product->section->name }}</td>
                                            <td>
                                                @if($product->status == 1)
                                                    <a class="updateStatus" record="product" href="javascript:void(0)" record_id="{{ $product->id  }}"> <span id="product-{{$product->id}}" class="badge badge-primary">Active</span> </a>
                                                @else
                                                    <a class="updateStatus" record="product" href="javascript:void(0)" record_id="{{ $product->id  }}"> <span id="product-{{$product->id}}" class="badge badge-primary">Inactive</span> </a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="productActions">
                                                    <a class="btn btn-dark btn-sm deleteBtn" title="Add Edit Attributes" href="{{ url('admin/add-attributes/'.$product->id) }}"><i class="fas fa-plus"></i></a>
                                                    <a class="btn btn-info btn-sm deleteBtn" title="Add Images" href="{{ url('admin/add-images/'.$product->id) }}"><i class="fas fa-image"></i></a>
                                                    <a class="btn btn-primary btn-sm deleteBtn" title="Edit Product" href="{{ url('admin/add-edit-product/'.$product->id) }}"><i class="fas fa-edit"></i></a>
                                                    <a title="Delete Product" class="btn btn-danger confirmDelete deleteBtn" record="product" recordId="{{ $product->id }}" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
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


