<?php
use App\Product;
?>

@extends('layouts.front.front')

@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>
                        <a href="{{ url('/'.$productDetails['category']['url']) }}">{{ $productDetails['category']['category_name'] }}</a>
                    </li>
                    <li class="active">{{ $productDetails['product_name'] }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="row single-product-area">
                <div class="col-lg-5 col-md-6">
                    <!-- Product Details Left -->
                    <div class="product-details-left sp-tab-style-left-page">
                        <div class="product-details-images slider-navigation-1">
                            <div class="lg-image">
                                <a class="popup-img venobox vbox-item"
                                   href="{{ asset('images/productImages/medium/'.$productDetails['product_image']) }}"
                                   data-gall="myGallery">
                                    <img
                                        src="{{ asset('images/productImages/large/'.$productDetails['product_image']) }}"
                                        style="width:100%" alt="image!"/>
                                </a>
                            </div>
                            @foreach($productDetails['images'] as $image)
                                <div class="lg-image">
                                    <a class="popup-img venobox vbox-item"
                                       href="{{ asset('images/productImages/medium/'.$image['image']) }}"
                                       data-gall="myGallery">
                                        <img src="{{ asset('images/productImages/medium/'.$image['image']) }}"
                                             alt="product image">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="tab-style-left">
                            <div class="sm-image"><img
                                    src="{{ asset('images/productImages/large/'.$productDetails['product_image']) }}"
                                    alt="product image thumb"></div>
                            @foreach($productDetails['images'] as $image)
                                <div class="sm-image"><img
                                        src="{{ asset('images/productImages/medium/'.$image['image']) }}"
                                        alt="product image thumb"></div>
                            @endforeach
                        </div>
                    </div>
                    <!--// Product Details Left -->
                </div>

                <div class="col-lg-7 col-md-6">
                    @if(Session::has('successMessage'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('successMessage')  }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(Session::has('errorMessage'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('errorMessage')  }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="product-details-view-content pt-60">
                        <div class="product-info">
                            <h2>{{ $productDetails['product_name'] }}</h2>
                            <div class="d-flex align-items-center">
                                <span
                                    class="product-details-ref mr-2">Brand: {{ $productDetails['brand']['name'] }}</span>
                                @if($totalStock > 0)
                                    <span class="text-success"> -  In stock</span>
                                @else
                                    <span class="text-danger"> -  Out of stock</span>
                                @endif
                            </div>
                            <div class="rating-box pt-20">
                                <ul class="rating rating-with-review-item">
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                    <li class="review-item"><a href="#">Read Review</a></li>
                                    <li class="review-item"><a href="#">Write Review</a></li>
                                </ul>
                            </div>
                            <?php $discountPrice = Product::getDiscountedPrice($productDetails['id']);?>
                            <div class="price-box pt-20">
                                @if($discountPrice > 0)
                                    <div class="price-box">
                                        <del>Tk {{ $productDetails['product_price'] }}</del>
                                        <span class="new-price new-price-2">Tk {{ $discountPrice }}</span>
                                        <span
                                            class="discount-percentage">-{{ $productDetails['product_discount'] }}%</span>
                                    </div>
                                @else
                                    <div class="price-box">
                                        <span class="new-price">Tk.{{$productDetails['product_price']}}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="product-desc">
                                <p>
                                    <span>{{ $productDetails['product_description'] }}</span>
                                </p>
                            </div>
                            <form action="{{ url('add-to-cart') }}" method="post" class="form-horizontal qtyFrm">@csrf
                                <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
                                <div class="product-variants">
                                    <div class="produt-variants-size">
                                        <label>Size</label>
                                        <select class="nice-select" name="size" required>
                                            @foreach($productDetails['attributes'] as $attribute)
                                                <option
                                                    value="{{ $attribute['size'] }}">{{ $attribute['size'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="single-add-to-cart">
                                    <div class="quantity d-flex flex-column">
                                        <p style="color:#626262; font-size:15px; font-weight:bold; margin-top:1rem">
                                            Quantity</p>
                                        <div class="d-flex">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" name="quantity" value="1"
                                                       type="text">
                                                <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                            </div>
                                            <button class="add-to-cart" type="submit">Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="product-additional-info pt-25">
                                <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add to
                                    wishlist</a>
                                <div class="product-social-sharing pt-25">
                                    <ul>
                                        <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                        <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                        <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google
                                                +</a></li>
                                        <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="block-reassurance">
                                <ul>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-check-square-o"></i>
                                            </div>
                                            <p>Security policy (edit with Customer reassurance module)</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-truck"></i>
                                            </div>
                                            <p>Delivery policy (edit with Customer reassurance module)</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-exchange"></i>
                                            </div>
                                            <p> Return policy (edit with Customer reassurance module)</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wraper end -->

    <!-- Begin Product Area -->
    <div class="product-area pt-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="li-product-tab">
                        <ul class="nav li-product-menu">
                            <li><a class="active" data-toggle="tab" href="#product-details"><span>Product Details</span></a>
                            </li>
                            <li><a data-toggle="tab" href="#description"><span>Description</span></a></li>
                            <li><a data-toggle="tab" href="#reviews"><span>Reviews</span></a></li>
                        </ul>
                    </div>
                    <!-- Begin Li's Tab Menu Content Area -->
                </div>
            </div>
            <div class="tab-content">
                <div id="product-details" class="tab-pane active show" role="tabpane1">
                    <div class="product-details-manufacturer row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td><strong>Product Code: </strong></td>
                                    <td><p> {{ $productDetails['product_code'] }}</p></td>
                                </tr>
                                <tr>
                                    <td><strong>Color: </strong></td>
                                    <td><p> {{ $productDetails['product_color'] }}</p></td>
                                </tr>

                                @if(!empty($productDetails['fabric']))
                                    <tr>
                                        <td><strong>Fabric: </strong></td>
                                        <td><p> {{ $productDetails['fabric'] }}</p></td>
                                    </tr>
                                @endif
                                @if(!empty($productDetails['pattern']))
                                    <tr>
                                        <td><strong>Pattern: </strong></td>
                                        <td><p> {{ $productDetails['pattern'] }}</p></td>
                                    </tr>
                                @endif
                                @if(!empty($productDetails['sleeve']))
                                    <tr>
                                        <td><strong>Sleeve: </strong></td>
                                        <td><p> {{ $productDetails['sleeve'] }}</p></td>
                                    </tr>
                                @endif
                                @if(!empty($productDetails['fit']))
                                    <tr>
                                        <td><strong>Fit: </strong></td>
                                        <td><p> {{ $productDetails['fit'] }}</p></td>
                                    </tr>
                                @endif
                                @if(!empty($productDetails['occasion']))
                                    <tr>
                                        <td><strong>Occasion: </strong></td>
                                        <td><p> {{ $productDetails['occasion'] }}</p></td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-6">
                            @if(!empty($productDetails['wash_care']))
                                <h6>Washcare</h6>
                                <p>{{ $productDetails['wash_care'] }}</p>
                            @endif
                            <h6 class="mt-4">Disclaimer</h6>
                            <p>
                                There may be a slight color variation between the image shown and original product.
                            </p>
                        </div>
                    </div>
                </div>
                <div id="description" class="tab-pane" role="tabpane">
                    <div class="product-description">
                        <span>{{ $productDetails['product_description'] }}</span>
                    </div>
                </div>
                <div id="reviews" class="tab-pane" role="tabpanel">
                    <div class="product-reviews">
                        <div class="product-details-comment-block">
                            {{--                            <div class="comment-review">--}}
                            {{--                                <span>Grade</span>--}}
                            {{--                                <ul class="rating">--}}
                            {{--                                    <li><i class="fa fa-star-o"></i></li>--}}
                            {{--                                    <li><i class="fa fa-star-o"></i></li>--}}
                            {{--                                    <li><i class="fa fa-star-o"></i></li>--}}
                            {{--                                    <li class="no-star"><i class="fa fa-star-o"></i></li>--}}
                            {{--                                    <li class="no-star"><i class="fa fa-star-o"></i></li>--}}
                            {{--                                </ul>--}}
                            {{--                            </div>--}}

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="review-btn">
                                        <a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">Write
                                            Your
                                            Review!</a>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    @if(!empty($productDetails['reviews']))
                                        @foreach($productDetails['reviews'] as $review)
                                            <div class="col-md-12">
                                                <div class="comment-author-infos pt-25">
                                                    <span>{{ $review['user']['name'] ?? 'User' }}</span>
                                                    @for($i=1; (int)$i<=$review['rating']; $i++)
                                                        <label style="color: #fdd838" for="5-stars" class="star">&#9733;</label>
                                                    @endfor
                                                    <em>{{ Carbon\Carbon::parse($review['created_at'])->diffForHumans() }}</em>
                                                </div>
                                                <div class="comment-details">
                                                    <p>{{ $review['review'] }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <!-- Begin Quick View | Modal Area -->
                            <div class="modal fade modal-wrapper" id="mymodal">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h3 class="review-page-title">Write Your Review</h3>
                                            <div class="modal-inner-area row">
                                                <div class="col-lg-12">
                                                    <div class="li-review-content">
                                                        <div class="feedback-area">
                                                            <div class="feedback">
                                                                <form action="{{ url('review') }}" method="post">@csrf
                                                                    <p class="your-opinion">
                                                                        <label for="starRating">Your Rating</label>
                                                                        <span>
                                                                            <select class="star-rating" id="starRating"
                                                                                    name="rating">
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                            </select>
                                                                        </span>
                                                                    </p>
                                                                    <input type="hidden"
                                                                           value="{{ $productDetails['id'] }}"
                                                                           name="product_id">
                                                                    <p class="feedback-form">
                                                                        <label for="feedback">Your Review</label>
                                                                        <textarea id="feedback" name="review" cols="45"
                                                                                  rows="8"
                                                                                  aria-required="true"></textarea>
                                                                    </p>
                                                                    <div class="feedback-input">
                                                                        <div class="feedback-btn pb-15">
                                                                            <a href="#" class="close"
                                                                               data-dismiss="modal" aria-label="Close">Close</a>
                                                                            <button type="submit">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Quick View | Modal Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End Here -->
    <!-- Begin Li's Laptop Product Area -->
    <section class="product-area li-laptop-product pt-30 pb-50">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>Related Products</span>
                        </h2>
                    </div>
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach($relatedProducts as $relatedProduct)
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <?php $productImagePath = 'images/productImages/small/' . $relatedProduct['product_image'] ?>
                                            <a href="{{ url('product/'.$relatedProduct['id'].'/'.$relatedProduct['product_name']) }}">
                                                @if(!empty($relatedProduct['product_image']) && file_exists($productImagePath))
                                                    <img style="width: 180px; height: 180px"
                                                         class="listingPageProductImage"
                                                         src="{{ asset($productImagePath) }}" alt="">
                                                @else
                                                    <img class="listingPageProductImage"
                                                         src="{{ asset('images/productImages/small/smallDummyImg.png') }}"
                                                         alt="">
                                                @endif
                                            </a>
                                            @if(now()->diffInDays($relatedProduct['created_at']) < 7)
                                                <span class="sticker">
                                                    New
                                                </span>
                                            @endif
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a href="#">{{ $relatedProduct['brand']['name'] }}</a>
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
                                                <h4><a class="product_name"
                                                       href="{{ url('product/'.$relatedProduct['id'].'/'.$relatedProduct['product_name']) }}">{{ $relatedProduct['product_name'] }}</a>
                                                </h4>
                                                <?php $discountPrice = Product::getDiscountedPrice($relatedProduct['id']);?>
                                                @if($discountPrice > 0)
                                                    <div class="price-box">
                                                        <span
                                                            class="new-price new-price-2">Tk. {{ $discountPrice }}</span>
                                                        <span
                                                            class="old-price">{{ $relatedProduct['product_price'] }}</span>
                                                        <span class="discount-percentage">-{{ $relatedProduct['product_discount'] }}%</span>
                                                    </div>
                                                @else
                                                    <div class="price-box">
                                                        <span
                                                            class="new-price">Tk. {{$relatedProduct['product_price']}}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active"><a
                                                            href="{{ url('product/'.$relatedProduct['id'].'/'.$relatedProduct['product_name']) }}">Add
                                                            to cart</a></li>
                                                    <li><a href="#" title="quick view" class="quick-view-btn"
                                                           data-toggle="modal" data-target="#exampleModalCenter"><i
                                                                class="fa fa-eye"></i></a></li>
                                                    <li><a class="links-details" href="#"><i class="fa fa-heart-o"></i></a>
                                                    </li>
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
                <!-- Li's Section Area End Here -->
            </div>
        </div>
    </section>
    <!-- Li's Laptop Product Area End Here -->
@endsection
