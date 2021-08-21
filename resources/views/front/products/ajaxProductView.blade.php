<?php
use App\Product;
?>
<div class="row">
    @foreach($categoryProducts as $product)
    <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
        <!-- single-product-wrap start -->
        <div class="single-product-wrap">
            <div class="product-image">
                <a href="{{ url('product/'.$product['id'].'/'.$product['product_name']) }}">
                    <?php $productImagePath = 'images/productImages/small/'.$product['product_image'] ?>
                    @if(!empty($product['product_image']) && file_exists($productImagePath))
                        <img src="{{ asset($productImagePath) }}" alt="">
                    @else
                        <img src="{{ asset('images/productImages/small/smallDummyImg.png') }}" alt="">
                    @endif
                </a>
                @if(now()->diffInDays($product['created_at']) < 7)
                    <span class="sticker">
                        New
                    </span>
                @endif
            </div>
            <div class="product_desc">
                <div class="product_desc_info">
                    <div class="product-review">
                        <h5 class="manufacturer">
                            <a href="product-details.html">{{ $product['brand']['name'] }}</a>
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
                    <h4><a class="product_name" href="single-product.html">{{ $product['product_name'] }}</a></h4>
                    <div class="price-box">
                        <?php $discountPrice = Product::getDiscountedPrice($product['id']);?>
                        @if($discountPrice > 0)
                            <div class="price-box">
                                <span class="new-price new-price-2">Tk.{{ $discountPrice }}</span>
                                <span class="old-price">Tk.{{ $product['product_price'] }}</span>
                                <span class="discount-percentage">-{{ $product['product_discount'] }}%</span>
                            </div>
                        @else
                            <div class="price-box">
                                <span class="new-price">Tk.{{$product['product_price']}}</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="add-actions">
                    <ul class="add-actions-link">
                        <li class="add-cart active"><a href="{{ url('product/'.$product['id'].'/'.$product['product_name']) }}">Add to cart</a></li>
                        <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                        <li><a class="links-details" href="#"><i class="fa fa-heart-o"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- single-product-wrap end -->
    </div>
@endforeach
</div>
