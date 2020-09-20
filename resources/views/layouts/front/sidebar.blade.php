<?php 
use App\Section;
$sections = Section::section();
?>

<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="product_summary.html"><img src="{{asset('images/frontImages/ico-cart.png')}}" alt="cart">3 Items in your cart</a></div>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
    @foreach($sections as $section)
        @if(count($section['categories']) > 0)
            <li class="subMenu"><a>{{$section['name']}}</a>
            @foreach($section['categories'] as $category)
                <ul>
                    <li><a href="{{ url($category['url']) }}"><i class="icon-chevron-right"></i><strong>{{ $category['category_name'] }}</strong></a></li>
                    @foreach($category['sub_categories'] as $subCategories)
                        <li><a href="{{ url($subCategories['url']) }}"><i class="icon-chevron-right"></i>{{$subCategories['category_name']}}</a></li>
                    @endforeach
                </ul>
            @endforeach
            </li>
        @endif
    @endforeach
    </ul>
    <br/>
    <div class="thumbnail">
        <img src="{{asset('images/frontImages/payment_methods.png')}}" title="Payment Methods" alt="Payments Methods">
        <div class="caption">
            <h5>Payment Methods</h5>
        </div>
    </div>
</div>
