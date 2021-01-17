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
                            <li class="breadcrumb-item active"><a href="{{ url('admin/add-edit-coupon') }}">Add coupons</a></li>
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

                <!-- Add coupon form -->
                <form method="post" @if(empty($coupon['id'])) action="{{ url('admin/add-edit-coupon') }}" @else action="{{ url('admin/add-edit-coupon/'.$coupon['id']) }}" @endif id="addcouponForm">@csrf
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
                                    <label>Coupon Option: </label>&nbsp
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="automaticCoupon" name="coupon_option" value="Automatic" checked>
                                            <label for="automaticCoupon">Automatic</label>
                                        </div>&nbsp;
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="manualCoupon" name="coupon_option" value="Manual">
                                            <label for="manualCoupon">Manual</label>
                                        </div>
                                    </div>
                                    <div class="form-group" id="couponField" style="display:none">
                                        <label for="coupon_code">Code</label>
                                        <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="Enter Coupon Code" @if(!empty($coupon['coupon_code'])) value="{{ $coupon['coupon_code'] }}" @else value="{{ old('$coupon_code') }}" @endif>
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <label>Select Categories</label>
                                        <select name="categories[]" class="form-control select2" style="width: 100%;" id="categories" multiple="" required>
                                            <option value="">Select</option> 
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
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Coupon Type:</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="multipleCoupon" name="coupon_type" value="Multiple" checked>
                                                <label for="multipleCoupon">Multiple Times</label>
                                            </div>&nbsp;
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="singleCoupon" name="coupon_type" value="Single">
                                                <label for="singleCoupon">Single Times</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="users">Select Users</label>
                                        <select name="users[]" id="users" class="form-control select2 "multiple="" data-live-search="true" required>
                                            @foreach($users as $user)
                                                <option value="{{ $user['email'] }}">{{ $user['email'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Amount Type:</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="percentage" name="amount_type" value="Percentage" checked>
                                                <label for="percentage">Percentage <span style="font-size:14px">( in % )</span></label>
                                            </div>&nbsp;
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="fixed" name="amount_type" value="Fixed">
                                                <label for="fixed">Fixed <span style="font-size:14px">( in TK or USD )</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount" @if(!empty($coupon['amount'])) value="{{ $coupon['amount'] }}" @else value="{{ old('$amount') }}" @endif required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="expiry_date">Expiry Date:</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" name="expiry_date" id="expiry_date" class="form-control datetimepicker-input" data-target="#reservationdate" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask required/>
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->  
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</Button>
                            <a href="{{ url('admin/coupons') }}" class="btn btn-dark btn-sm">Go back</a>
                        </div>
                    </div>
                    <!-- /.card -->
                </form>
                <!-- /.Add coupon form -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
    <script>
        // Date picker format
        $('#reservationdate').datetimepicker({
            format: 'YYYY/MM/DD'
        });

        //Datemask dd/mm/yyyy
        $('#expiry_date').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
    </script>
@endsection