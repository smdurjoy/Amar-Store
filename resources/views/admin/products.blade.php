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
                                <h3 class="card-title">Products</h3>
                                <a href="{{ url('admin/add-edit-product') }}" class="btn btn-dark" style="float: right"> Add Products</a>
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
                                        <th>Category</th>
                                        <th>Section</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
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
                                            <td>{{ $product->category->category_name }}</td>
                                            <td>{{ $product->section->name }}</td>
                                            <td>
                                                @if($product->status == 1)
                                                    <a class="updateProductStatus" id="product-{{$product->id}}" href="javascript:void(0)" product_id="{{ $product->id  }}"> Active </a>
                                                @else
                                                    <a class="updateProductStatus" id="product-{{$product->id}}" href="javascript:void(0)" product_id="{{ $product->id  }}"> Inactive </a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="productActions">
                                                    <a title="Add Edit Attributes" href="{{ url('admin/add-attributes/'.$product->id) }}"><i class="fas fa-plus"></i></a>
                                                    <a title="Add Images" href="{{ url('admin/add-images/'.$product->id) }}"><i class="fas fa-image"></i></a>
                                                    <a title="Edit Product" href="{{ url('admin/add-edit-product/'.$product->id) }}"><i class="fas fa-edit"></i></a>
                                                    <a title="Delete Product" class="confirmDelete" record="product" recordId="{{ $product->id }}" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
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


