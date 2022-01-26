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
                            <li class="breadcrumb-item active"><a href=" {{url('/admin/reviews')}} ">Reviews</a></li>
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
                                <h3 class="card-title">Reviews</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="categoryTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-bold">SL</th>
                                        <th class="text-bold">Product Image</th>
                                        <th class="text-bold">Section</th>
                                        <th class="text-bold">Category</th>
                                        <th class="text-bold">Product</th>
                                        <th class="text-bold">Review</th>
                                        <th class="text-bold">Rating</th>
                                        <th class="text-bold">Status</th>
                                        <th class="text-bold">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($reviews as $key => $review)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                @if(isset($review->product->product_image))
                                                    <?php $imgPath = "images/productImages/small/" . $review->product->product_image; ?>
                                                    @if(file_exists($imgPath))
                                                        <img class="productImage"
                                                             src="{{ asset($imgPath) }}"
                                                             alt="product photo"
                                                        >
                                                    @else
                                                        <img class="productImage"
                                                             src="{{ asset('images/productImages/small/smallDummyImg.png') }}"
                                                             alt="not found">
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{ $review->product->section->name ?? '' }}</td>
                                            <td>{{ $review->product->category->category_name ?? '' }}</td>
                                            <td>
                                                @if($review->product)
                                                    <a style="color: blue" href="{{ url('product/'.$review->product->id.'/'.$review->product->product_name) }}">
                                                        {{ $review->product->product_name }}
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $review->review }}</td>
                                            <td>
                                                @for($i=1; $i<=(int)$review->rating; $i++)
                                                    <label style="color: #fdd838" for="5-stars"
                                                           class="star">&#9733;</label>
                                                @endfor
                                            </td>
                                            <td>
                                                @if($review->status == 1)
                                                    <a class="updateStatus" record="review" href="javascript:void(0)"
                                                       record_id="{{ $review->id  }}"> <span
                                                            id="review-{{$review->id}}" class="badge badge-primary">Active</span>
                                                    </a>
                                                @else
                                                    <a class="updateStatus" record="review" href="javascript:void(0)"
                                                       record_id="{{ $review->id  }}"> <span
                                                            id="review-{{$review->id}}" class="badge badge-primary">Inactive</span>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <a title="Delete Category"
                                                   class="btn btn-danger deleteBtn confirmDelete" record="review"
                                                   recordId="{{ $review->id }}" href="javascript:void(0)"><i
                                                        class="fas fa-trash"></i></a>
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
