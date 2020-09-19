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
                            <li class="breadcrumb-item active"><a href="{{ url('admin/add-edit-category') }}">Add Categories</a></li>
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

                <!-- Add Category form -->
                <form method="post" @if(empty($categoryData['id'])) action="{{ url('admin/add-edit-category') }}" @else action="{{ url('admin/add-edit-category/'.$categoryData['id']) }}" @endif id="addCategoryForm" enctype="multipart/form-data">@csrf
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
                                        <label for="category_name">Category Name</label>
                                        <input type="text" class="form-control" name="category_name" id="categoryName" placeholder="Enter Category Name" @if(!empty($categoryData['category_name'])) value="{{ $categoryData['category_name'] }}" @else value="{{ old('$category_name') }}" @endif>
                                    </div>
                                    <div id="categoriesLevel">
                                        @include('admin.categoriesLevel')
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Section</label>
                                        <select name="section_id" class="form-control select2" style="width: 100%;" id="section_id">
                                            <option selected="selected">Select</option>
                                            @foreach($getSections as $section)
                                                <option value="{{ $section->id }}" @if(!empty($categoryData['section_id']) && $categoryData['section_id'] == $section->id) selected @endif>
                                                    {{ $section->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="exampleInputFile">Category Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="categoryImage" name="category_image">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        @if(!empty($categoryData['category_image']))
                                            <img src="{{ asset('images/categoryImages/'.$categoryData['category_image']) }}" alt="image!" style="margin-top: 5px; height: 80px; width: 80px; margin-bottom: 5px">&nbsp; <?php /* <a href="{{ url('admin/delete-category-image/'.$categoryData['id']) }}"> */?><a class="confirmDelete" href="javascript:void(0)" record="category-image" recordId="{{ $categoryData['id'] }}">Delete Photo</a>
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
                                        <label for="category_discount">Category Discount</label>
                                        <input type="text" class="form-control" placeholder="Enter Category Discount" name="category_discount" id="categoryDiscount" @if(!empty($categoryData['category_discount'])) value="{{ $categoryData['category_discount'] }}" @else value="{{ old('$category_discount') }}" @endif>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="category_url">Category Url</label>
                                        <input type="text" class="form-control" placeholder="Enter Category Url" name="url" id="categoryUrl" @if(!empty($categoryData['url'])) value="{{ $categoryData['url'] }}" @else value="{{ old('$url') }}" @endif>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="category_description">Category Description</label>
                                        <textarea class="form-control" rows="3" placeholder="Enter Category Description ..." name="description" id="categoryDes">@if(!empty($categoryData['description'])) {{$categoryData['description']}} @else {{old('$description')}} @endif</textarea>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea class="form-control" rows="3" placeholder="Enter Meta Description ..." name="meta_description" id="metaDes">@if(!empty($categoryData['meta_description'])) {{ $categoryData['meta_description'] }} @else {{ old('$meta_description') }} @endif</textarea>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Meta Title" name="meta_title" id="metaTitle" @if(!empty($categoryData['meta_title'])) value="{{ $categoryData['meta_title'] }}" @else value="{{ old('$meta_title') }}" @endif>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keyword</label>
                                        <input type="text" class="form-control" placeholder="Enter Meta Keyword" name="meta_keywords" id="categoryUrl" @if(!empty($categoryData['meta_keywords'])) value="{{ $categoryData['meta_keywords'] }}" @else value="{{ old('$meta_keywords') }}" @endif>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
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
                <!-- /.Add category form -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
