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
                            <li class="breadcrumb-item active"><a href="{{ url('admin/add-edit-product') }}">Add Products</a></li>
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
                                        <label>Select Category</label>
                                        <select name="category_id" class="form-control select2" style="width: 100%;" id="categoryId">
                                            <option selected="selected">Select</option>
                                            @foreach($categories as $section)
                                                <optgroup label="{{ $section['name'] }}"></optgroup>
                                                @foreach($section['categories'] as $category)
                                                    <option value="{{ $category['id'] }}" @if(!empty(@old('category_id')) && $category['id'] == @old('category_id')) selected @elseif (!empty($productData['category_id']) && $productData['category_id'] == $category['id']) selected @endif>&nbsp;&nbsp;--&nbsp;
                                                        {{ $category['category_name'] }}
                                                    </option>
                                                    @foreach($category['sub_categories'] as $subcategory)
                                                        <option value="{{ $subcategory['id'] }}" @if(!empty(@old('category_id')) && $subcategory['id'] == @old('category_id')) selected @elseif (!empty($productData['category_id']) && $productData['category_id'] == $subcategory['id']) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;
                                                            {{ $subcategory['category_name'] }}
                                                        </option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_name">Product Name</label>
                                        <input type="text" class="form-control" name="product_name" id="productName" placeholder="Enter Product Name" @if(!empty($productData['product_name'])) value="{{ $productData['product_name'] }}" @else value="{{ old('$product_name') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_color">Product Color</label>
                                        <input type="text" class="form-control" placeholder="Enter Product Color" name="product_color" id="productColor" @if(!empty($productData['product_color'])) value="{{ $productData['product_color'] }}" @else value="{{ old('product_color') }}" @endif>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Brand</label>
                                        <select name="brand_id" class="form-control select2" style="width: 100%;" id="brand_id">
                                            <option value="" selected>Select</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand['id'] }}" @if(!empty($productData['brand_id']) && $productData['brand_id'] == $brand['id']) selected @endif>{{ $brand['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_code">Product Code</label>
                                        <input type="text" class="form-control" name="product_code" id="productCode" placeholder="Enter Product Code" @if(!empty($productData['product_code'])) value="{{ $productData['product_code'] }}" @else value="{{ old('$product_code') }}" @endif>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="product_image">Product Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="product_image" name="product_image">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                        <div>Recommended size Width: 1040px, Height:1200px</div>
                                    </div>
                                    <div>
                                        @if(!empty($productData['product_image']))
                                            <img src="{{ asset('images/productImages/small/'.$productData['product_image']) }}" alt="image!" style="margin-top: 5px; height: 80px; width: 80px; margin-bottom: 5px">&nbsp; <a class="confirmDelete" href="javascript:void(0)" record="product-image" recordId="{{ $productData['id'] }}">Delete Photo</a>
                                        @endif
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="product_weight">Product Weight</label>
                                        <input type="text" class="form-control" placeholder="Enter Product Weight" name="product_weight" id="productWeight" @if(!empty($productData['product_weight'])) value="{{ $productData['product_weight'] }}" @else value="{{ old('product_weight') }}" @endif>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="product_price">Product Price</label>
                                        <input type="text" class="form-control" placeholder="Enter Product Price" name="product_price" id="productPrice" @if(!empty($productData['product_price'])) value="{{ $productData['product_price'] }}" @else value="{{ old('product_price') }}" @endif>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="product_discount">Product Discount (%)</label>
                                        <input type="text" class="form-control" placeholder="Enter Product Discount" name="product_discount" id="productDiscount" @if(!empty($productData['product_discount'])) value="{{ $productData['product_discount'] }}" @else value="{{ old('product_discount') }}" @endif>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="product_video">Product Video</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="product_video" name="product_video">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    @if(!empty($productData['product_video']))
                                        <a href="{{ url('videos/productVideos/'.$productData['product_video']) }}" download>Download Video</a>
                                        ||
                                        <a class="confirmDelete" href="javascript:void(0)" record="product-video" recordId="{{ $productData['id'] }}">Delete Video</a>
                                    @endif
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="wash_care">Wash Care</label>
                                        <textarea class="form-control" rows="3" placeholder="Enter Wash Care ..." name="wash_care" id="wash_care">@if(!empty($productData['wash_care'])) {{$productData['wash_care']}} @else {{old('wash_care')}} @endif</textarea>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="product_description">Product Description</label>
                                        <textarea class="form-control" rows="3" placeholder="Enter Product Description ..." name="product_description" id="productDes">@if(!empty($productData['product_description'])) {{$productData['product_description']}} @else {{old('product_description')}} @endif</textarea>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea class="form-control" rows="3" placeholder="Enter Meta Description ..." name="meta_description" id="metaDes">@if(!empty($productData['meta_description'])) {{ $productData['meta_description'] }} @else {{ old('meta_description') }} @endif</textarea>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Select Fabric</label>
                                        <select name="fabric" class="form-control select2" style="width: 100%;" id="category_id">
                                            <option value="" selected>Select</option>
                                            @foreach($fabricArray as $fabric)
                                                <option value="{{ $fabric['filter_value'] }}" @if(!empty($productData['fabric']) && $productData['fabric'] == $fabric['filter_value']) selected @endif>{{ $fabric['filter_value'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Select Sleeve</label>
                                        <select name="sleeve" class="form-control select2" style="width: 100%;" id="sleeve">
                                            <option value="" selected>Select</option>
                                            @foreach($sleeveArray as $sleeve)
                                                <option value="{{ $sleeve['filter_value'] }}" @if(!empty($productData['sleeve']) && $productData['sleeve'] == $sleeve['filter_value']) selected @endif>{{ $sleeve['filter_value'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Select Pattern</label>
                                        <select name="pattern" class="form-control select2" style="width: 100%;" id="pattern">
                                            <option value="" selected>Select</option>
                                            @foreach($patternArray as $pattern)
                                                <option value="{{ $pattern['filter_value'] }}" @if(!empty($productData['pattern']) && $productData['pattern'] == $pattern['filter_value']) selected @endif>{{ $pattern['filter_value'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Select Fit</label>
                                        <select name="fit" class="form-control select2" style="width: 100%;" id="fit">
                                            <option value="" selected>Select</option>
                                            @foreach($fitArray as $fit)
                                                <option value="{{ $fit['filter_value'] }}" @if(!empty($productData['fit']) && $productData['fit'] == $fit['filter_value']) selected @endif>{{ $fit['filter_value'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Select Occasion</label>
                                        <select name="occasion" class="form-control select2" style="width: 100%;" id="occasion">
                                            <option value="" selected>Select</option>
                                            @foreach($occasionArray as $occasion)
                                                <option value="{{ $occasion['filter_value'] }}" @if(!empty($productData['occasion']) && $productData['occasion'] == $occasion['filter_value']) selected @endif>{{ $occasion['filter_value'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Meta Title" name="meta_title" id="metaTitle" @if(!empty($productData['meta_title'])) value="{{ $productData['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keyword</label>
                                        <input type="text" class="form-control" placeholder="Enter Meta Keyword" name="meta_keywords" id="productUrl" @if(!empty($productData['meta_keywords'])) value="{{ $productData['meta_keywords'] }}" @else value="{{ old('meta_keywords') }}" @endif>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="featured">Featured Item</label>
                                <input type="checkbox" id="is_featured" name="is_featured" value="Yes" @if(!empty($productData['is_featured']) && $productData['is_featured'] == "Yes") checked @endif>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary btn-sm">
                        </div>
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

