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

            <!-- Add Product Attribute Form -->
                <form method="post" action="{{ url('admin/add-attributes/'.$productData['id']) }}">@csrf
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
                                            <img src="{{ asset('images/productImages/small/'.$productData['product_image']) }}" alt="image!" style="margin-top: 5px; height: 80px; width: 80px; margin-bottom: 5px">&nbsp; <a class="btn btn-danger deleteBtn confirmDelete" title="Delete Photo" href="javascript:void(0)" record="product-image" recordId="{{ $productData['id'] }}"><i class="fas fa-trash"></i></a>
                                        @endif
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="field_wrapper col-md-12">
                                    <div class="d-flex">
                                        <input class="form-control mx-1" style="width:125px" type="text" name="size[]" id="size" placeholder="Size" required/>
                                        <input class="form-control mx-1" style="width:125px" type="text" name="sku[]" id="sku" placeholder="SKU" required/>
                                        <input class="form-control mx-1" style="width:125px" type="text" name="price[]" id="price" placeholder="Price" required/>
                                        <input class="form-control mx-1" style="width:125px" type="text" name="stock[]" id="stock" placeholder="Stock" required/>
                                        <a href="javascript:void(0);" class="add_button btn btn-primary btn-sm" title="Add field"> Add</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-primary btn-sm" type="submit">Add Attributes</button>
                            <a class="btn btn-dark btn-sm" href="{{ url('admin/products') }}">Go Back</a>
                        </div>
                    </div>
                    <!-- /.card -->
                </form>
                <!-- /.Add product form -->

                <!-- update-attribute-form -->
                <form method="post" action="{{ url('admin/edit-attributes/'.$productData['id']) }}">@csrf
                    <!-- Added product attributes -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Added Product Attributes</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="productTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-bold">SL.</th>
                                    <th class="text-bold">Size</th>
                                    <th class="text-bold">SKU</th>
                                    <th class="text-bold">Price</th>
                                    <th class="text-bold">Stock</th>
                                    <th class="text-bold">Status</th>
                                    <th class="text-bold">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productData['attributes'] as $key => $attribute)
                                    <input class="form-control d-none" name="attrId[]" value="{{ $attribute['id'] }}"/>
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $attribute['size'] }}</td>
                                        <td>{{ $attribute['sku'] }}</td>
                                        <td>
                                            <input class="form-control" type="text" name="price[]" id="size" placeholder="Size" value="{{ $attribute['price'] }}" required/>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" name="stock[]" id="stock" placeholder="Stock" value="{{ $attribute['stock'] }}" required/>
                                        </td>
                                        <td>
                                            @if($attribute['status'] == 1)
                                                <a class="updateStatus" record="attribute" href="javascript:void(0)" record_id="{{ $attribute['id'] }}"> <span id="attribute-{{ $attribute['id'] }}" class="badge badge-primary">Active</span> </a>
                                            @else
                                                <a class="updateStatus" record="attribute" href="javascript:void(0)" record_id="{{ $attribute['id'] }}"> <span id="attribute-{{ $attribute['id'] }}" class="badge badge-primary">Inactive</span> </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a title="Delete attribute" class="btn btn-danger deleteBtn confirmDelete" record="attribute" recordId="{{ $attribute['id'] }}" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-primary btn-sm" type="submit">Update Attributes</button>
                        </div>
                    </div>
                </form>
                <!-- /.update-attribute-form -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


