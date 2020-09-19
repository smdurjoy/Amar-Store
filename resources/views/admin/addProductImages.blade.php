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
                            <li class="breadcrumb-item active"><a href="{{ url('admin/add-edit-product') }}">Product Images</a></li>
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

                @if(Session::has('errorMessage'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        {{ Session::get('errorMessage')  }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

            <!-- Add Product image Form -->
                <form method="post" action="{{ url('admin/add-images/'.$productData['id']) }}" enctype="multipart/form-data">@csrf
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title"> Product Images </h3>

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
                                        <label for="product_image">Product Main Image</label>
                                        @if(!empty($productData['product_image']))
                                            <img src="{{ asset('images/productImages/small/'.$productData['product_image']) }}" alt="image!" style="margin-top: 5px; height: 80px; width: 80px; margin-bottom: 5px">&nbsp; 
                                            <a class="confirmDelete" href="javascript:void(0)" record="product-image" recordId="{{ $productData['id'] }}">Delete <i class="fas fa-trash"></i></a>
                                        @endif         
                                    </div>  
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="file" name="images[]" id="images" multiple="" required/>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-primary btn-sm" type="submit">Add images</button>
                        </div>
                    </div>
                    <!-- /.card -->
                </form>
                <!-- /.Add product form -->

                <!-- update-image-form -->
                <form method="post" action="{{ url('admin/edit-images/'.$productData['id']) }}">@csrf
                    <!-- Added product images -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Added Product images</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="productTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productData['images'] as $image)
                                    <input class="form-control d-none" name="attrId[]" value="{{ $image['id'] }}"/>
                                    <tr>
                                        <td>{{ $image['id'] }}</td>
                                        <td>
                                            <img src="{{ asset('images/productImages/small/'.$image['image']) }}" alt="image!" style="margin-top: 5px; height: 80px; width: 80px; margin-bottom: 5px">
                                        </td>
                                        <td>
                                            @if($image['status'] == 1)
                                                <a class="updateStatus" record="productImage" href="javascript:void(0)" record_id="{{ $image['id']  }}"> <span id="productImage-{{$image['id']}}" class="badge badge-primary">Active</span> </a>
                                            @else
                                                <a class="updateStatus" record="productImage" href="javascript:void(0)" record_id="{{ $image['id']  }}"> <span id="productImage-{{$image['id']}}" class="badge badge-primary">Inactive</span> </a>
                                            @endif
                                        </td> 
                                        <td class="text-center">
                                            <a title="Delete Product" class="confirmDelete" record="productImage" recordId="{{$image['id']}}" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </form>
                <!-- /.update-image-form -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


