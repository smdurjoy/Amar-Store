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
                            <li class="breadcrumb-item active"><a href="{{ url('admin/add-edit-product') }}">Product Attributes</a></li>
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

                @if(Session::has('successMessage'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        {{ Session::get('successMessage')  }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

            <!-- Add Product form -->
                <form method="post" @if(empty($productData['id'])) action="{{ url('admin/add-edit-product') }}" @else action="{{ url('admin/add-edit-product/'.$productData['id']) }}" @endif id="addProductForm" enctype="multipart/form-data">@csrf
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title"> {{ $title }} </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">                 
                                    <div class="form-group">
                                        <label for="product_name">Product Name:</label> &nbsp;
                                        {{ $productData['product_name'] }}
                                    </div>
                                    <div class="form-group">
                                        <label for="product_code">Product Code:</label> &nbsp;
                                        {{ $productData['product_code'] }}
                                    </div>
                                    <div class="form-group">
                                        <label for="product_color">Product Color:</label> &nbsp;
                                        {{ $productData['product_color'] }}
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_image">Product Image</label>
                                        @if(!empty($productData['product_image']))
                                            <img src="{{ asset('images/productImages/small/'.$productData['product_image']) }}" alt="image!" style="margin-top: 5px; height: 80px; width: 80px; margin-bottom: 5px">&nbsp; <a class="confirmDelete" href="javascript:void(0)" record="product-image" recordId="{{ $productData['id'] }}">Delete Photo</a>
                                        @endif         
                                    </div>  
                                    <!-- /.form-group -->
                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="field_wrapper col-md-12">
                                    <div class="d-flex">
                                        <input class="form-control mx-1" style="width:125px" type="text" name="size" id="size" placeholder="Size"/>
                                        <input class="form-control mx-1" style="width:125px" type="text" name="sku" id="sku" placeholder="SKU"/>
                                        <input class="form-control mx-1" style="width:125px" type="text" name="price" id="price" placeholder="Price"/>
                                        <input class="form-control mx-1" style="width:125px" type="text" name="stock" id="stock" placeholder="Stock"/>
                                        <a href="javascript:void(0);" class="add_button btn btn-primary btn-sm" title="Add field"> Add</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </form>
                <!-- /.Add product form -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


