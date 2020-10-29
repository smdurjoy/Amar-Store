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
                            <li class="breadcrumb-item active"><a href="{{ url('admin/add-edit-banner') }}">Add Banner</a></li>
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
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        {{ Session::get('successMessage')  }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <!-- Add banner form -->
                <form method="post" @if(empty($banner['id'])) action="{{ url('admin/add-edit-banner') }}" @else action="{{ url('admin/add-edit-banner/'.$banner['id']) }}" @endif id="addbannerForm" enctype="multipart/form-data">@csrf
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
                                        <label for="banner_title">Banner Title</label>
                                        <input type="text" class="form-control" placeholder="Enter banner title" name="banner_title" id="bannerTitle" @if(!empty($banner['title'])) value="{{ $banner['title'] }}" @else value="{{ old('$banner_title') }}" @endif>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Banner Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="bannerImage" name="banner_image">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                        <small class="text-muted">Recommended Image Size: 1170 x 480 px</small>
                                    </div>
                                    <div>
                                        @if(!empty($banner['image']))
                                            <img src="{{ asset('images/bannerImages/'.$banner['image']) }}" alt="image!" style="height: 80px; width: 180px; margin-bottom: 10px">&nbsp; 
                                            <a class="confirmDelete" href="javascript:void(0)" record="banner-image" recordId="{{ $banner['id'] }}">Delete Photo</a>
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
                                        <label for="banner_link">Banner Link</label>
                                        <input type="text" class="form-control" placeholder="Enter banner link" name="banner_link" id="bannerLink" @if(!empty($banner['link'])) value="{{ $banner['link'] }}" @else value="{{ old('$banner_link') }}" @endif>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="alt">Banner Alternative Text</label>
                                        <input type="text" class="form-control" placeholder="Enter banner alt text" name="alt" id="banneralt" @if(!empty($banner['alt'])) value="{{ $banner['alt'] }}" @else value="{{ old('$alt') }}" @endif>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <Button type="submit" class="btn btn-primary btn-sm">Submit</Button>
                            <a href="{{ url('admin/banners') }}" class="btn btn-dark btn-sm">Go back</a>
                        </div>
                    </div>
                    <!-- /.card -->
                </form>
                <!-- /.Add banner form -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
