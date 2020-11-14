<?php
use App\Product;
?>
<div class="tab-pane  active" id="blockView">
    <ul class="thumbnails">
    @foreach($categoryProducts as $product)
        <li class="span3">
            <div class="thumbnail">
                <a href="{{ url('product/'.$product['id'].'/'.$product['product_name']) }}">
                    <?php $productImagePath = 'images/productImages/small/'.$product['product_image'] ?>
                    @if(!empty($product['product_image']) && file_exists($productImagePath))
                        <img class="listingPageProductImage" src="{{ asset($productImagePath) }}" alt="">
                    @else
                        <img class="listingPageProductImage" src="{{ asset('images/productImages/small/smallDummyImg.png') }}" alt="">
                    @endif
                </a>
                <div class="caption">
                    <h5>{{ $product['product_name'] }}</h5>
                    <p>{{ $product['brand']['name'] }}</p>
                    <?php $discountPrice = Product::getDiscountedPrice($product['id']);?>
                    <h4 style="text-align:center"><a class="btn" href="{{ url('product/'.$product['id'].'/'.$product['product_name']) }}">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">
                    @if($discountPrice > 0)
                        Tk.<del>{{ $product['product_price'] }}</del> <span style="color: yellow;">{{ $discountPrice }}</span>
                    @else
                        Tk.{{ $product['product_price'] }}
                    @endif
                    </a></h4>
                </div>
            </div>
        </li>
    @endforeach
    </ul>
    <hr class="soft"/>
</div>
