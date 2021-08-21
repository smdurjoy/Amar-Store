<?php
use App\Product;
?>

@extends('layouts.front.front')

@section('content')
<!-- Begin Featured Products Area -->
<div class="product-area pt-60 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav li-product-menu active">
                    <li><a><span>Featured Products</span></a></li>
                </ul>               
            </div>
        </div>
        <div id="li-new-product" class="tab-pane active show" role="tabpanel">
            <div class="row">
                <div class="product-active owl-carousel">
                    @foreach($featuredItems as $item)
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="{{ url('product/'.$item['id'].'/'.$item['product_name']) }}">
                                        <?php $productImagePath = 'images/productImages/small/'.$item['product_image'] ?>
                                        @if(!empty($item['product_image']) && file_exists($productImagePath))
                                            <img src="{{ asset($productImagePath) }}" alt="">
                                        @else
                                            <img src="{{ asset('images/productImages/small/smallDummyImg.png') }}" alt="">
                                        @endif
                                    </a>
                                    @if(now()->diffInDays($item['created_at']) < 7)
                                        <span class="sticker">
                                            New
                                        </span>
                                    @endif
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="#">{{ $item['brand']['name'] }}</a>
                                            </h5>
                                            <div class="rating-box">
                                                <ul class="rating">
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <h4><a class="product_name" href="{{ url('product/'.$item['id'].'/'.$item['product_name']) }}">{{ $item['product_name'] }}</a></h4>

                                        <?php $discountPrice = Product::getDiscountedPrice($item['id']);?>
                                        @if($discountPrice > 0)
                                            <div class="price-box">
                                                <span class="new-price new-price-2">{{ $discountPrice }}</span>
                                                <span class="old-price">{{ $item['product_price'] }}</span>
                                                <span class="discount-percentage">-{{ $item['product_discount'] }}%</span>
                                            </div>
                                        @else
                                            <div class="price-box">
                                                <span class="new-price">Tk.{{$item['product_price']}}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="{{ url('product/'.$item['id'].'/'.$item['product_name']) }}">Add to cart</a></li>
                                            <li><a class="links-details" href="#"><i class="fa fa-heart-o"></i></a></li>
                                            <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Featured Products Area End Here -->

<!-- Begin Li's Static Banner Area -->
<div class="li-static-banner">
    <div class="container">
        <div class="row">
            <!-- Begin Single Banner Area -->
            <div class="col-lg-4 col-md-4 text-center">
                <div class="single-banner">
                    <a href="#">
                        <img src="{{ asset('utils-front/images/banner/1_3.jpg') }}" alt="Li's Static Banner">
                    </a>
                </div>
            </div>
            <!-- Single Banner Area End Here -->
            <!-- Begin Single Banner Area -->
            <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                <div class="single-banner">
                    <a href="#">
                        <img src="{{ asset('utils-front/images/banner/1_4.jpg') }}" alt="Li's Static Banner">
                    </a>
                </div>
            </div>
            <!-- Single Banner Area End Here -->
            <!-- Begin Single Banner Area -->
            <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                <div class="single-banner">
                    <a href="#">
                        <img src="{{ asset('utils-front/images/banner/1_5.jpg') }}" alt="Li's Static Banner">
                    </a>
                </div>
            </div>
            <!-- Single Banner Area End Here -->
        </div>
    </div>
</div>
<!-- Li's Static Banner Area End Here -->

<!-- Begin Latest Products Area -->
<div class="product-area pt-60 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav li-product-menu active">
                    <li><a><span>Latest Products</span></a></li>
                </ul>               
            </div>
        </div>
        <div id="li-new-product" class="tab-pane active show" role="tabpanel">
            <div class="row">
                <div class="product-active owl-carousel">
                    @foreach($latestProducts as $latestProduct)
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="{{ url('product/'.$latestProduct['id'].'/'.$latestProduct['product_name']) }}">
                                        <?php $productImagePath = 'images/productImages/small/'.$latestProduct['product_image'] ?>
                                        @if(!empty($latestProduct['product_image']) && file_exists($productImagePath))
                                            <img src="{{ asset('images/productImages/small/'.$latestProduct['product_image']) }}" alt="">
                                        @else
                                            <img src="{{ asset('images/productImages/small/smallDummyImg.png') }}" alt="">
                                        @endif
                                    </a>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="#">{{ $latestProduct['brand']['name'] }}</a>
                                            </h5>
                                            <div class="rating-box">
                                                <ul class="rating">
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <h4><a class="product_name" href="{{ url('product/'.$latestProduct['id'].'/'.$latestProduct['product_name']) }}">{{ $latestProduct['product_name'] }}</a></h4>
                                        @if($discountPrice > 0)
                                            <div class="price-box">
                                                <span class="new-price new-price-2">{{ $discountPrice }}</span>
                                                <span class="old-price">{{ $latestProduct['product_price'] }}</span>
                                                <span class="discount-percentage">-{{ $latestProduct['product_discount'] }}%</span>
                                            </div>
                                        @else
                                            <div class="price-box">
                                                <span class="new-price">Tk.{{$latestProduct['product_price']}}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="{{ url('product/'.$latestProduct['id'].'/'.$latestProduct['product_name']) }}">Add to cart</a></li>
                                            <li><a class="links-details" href="#"><i class="fa fa-heart-o"></i></a></li>
                                            <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Latest Products Area End Here -->
@endsection

@section('script')
<script>
    // fetch('https://api.smdurjoy.com/postVisitorDataEcom');
</script>
@endsection