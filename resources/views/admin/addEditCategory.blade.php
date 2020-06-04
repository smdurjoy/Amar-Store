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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Add Category form -->
                <form method="post" action="{{ url('admin/add-edit-category') }}" id="addCategoryForm" enctype="multipart/form-data">@csrf
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Add Categories</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_name">Category Name</label>
                                        <input type="text" class="form-control" name="category_name" id="categoryName" placeholder="Enter Category Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Select Category Label</label>
                                        <select name="parent_id" class="form-control select2" style="width: 100%;" id="parent_id">
                                            <option value="0">Main Category</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Section</label>
                                        <select name="section_id" class="form-control select2" style="width: 100%;" id="section_id">
                                            <option selected="selected">Select</option>
                                            @foreach($getSections as $section)
                                                <option value="{{ $section->id }}">{{ $section->name }}</option>
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
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="category_discount">Category Discount</label>
                                        <input type="text" class="form-control" placeholder="Enter Category Discount" name="category_discount" id="categoryDiscount">
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="category_url">Category Url</label>
                                        <input type="text" class="form-control" placeholder="Enter Category Url" name="url" id="categoryUrl">
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Category Description</label>
                                        <textarea class="form-control" rows="3" placeholder="Enter Category Description ..." name="description" id="categoryDes"></textarea>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="category_url">Meta Description</label>
                                        <textarea class="form-control" rows="3" placeholder="Enter Meta Description ..." name="meta_description" id="metaDes"></textarea>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="category_discount">Meta Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Meta Title" name="meta_title" id="metaTitle">
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="category_url">Meta Keyword</label>
                                        <input type="text" class="form-control" placeholder="Enter Meta Keyword" name="meta_keywords" id="categoryUrl">
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary">
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
