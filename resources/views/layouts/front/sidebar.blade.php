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
    </ul> <br>
    @if(isset($pageName) && $pageName = 'listing')
        <div class="well well-small">
            <h5>Fabric</h5>
            @foreach($fabricArray as $fabric)
                <input class="fabric" type="checkbox" style="margin-top: -3px" name="fabric[]" id="{{ $fabric['filter_value'] }}" value="{{ $fabric['filter_value'] }}">
                {{ $fabric['filter_value'] }}<br/>
            @endforeach
        </div>
        <div class="well well-small">
            <h5>Sleeve</h5>
            @foreach($sleeveArray as $sleeve)
                <input class="sleeve" type="checkbox" style="margin-top: -3px" name="sleeve[]" id="{{ $sleeve['filter_value'] }}" value="{{ $sleeve['filter_value'] }}">
                {{ $sleeve['filter_value'] }}<br/>
            @endforeach
        </div>
        <div class="well well-small">
            <h5>Pattern</h5>
            @foreach($patternArray as $pattern)
                <input class="pattern" type="checkbox" style="margin-top: -3px" name="pattern[]" id="{{ $pattern['filter_value'] }}" value="{{ $pattern['filter_value'] }}">
                {{ $pattern['filter_value'] }}<br/>
            @endforeach
        </div>
        <div class="well well-small">
            <h5>Fit</h5>
            @foreach($fitArray as $fit)
                <input class="fit" type="checkbox" style="margin-top: -3px" name="fit[]" id="{{ $fit['filter_value'] }}" value="{{ $fit['filter_value'] }}">
                {{ $fit['filter_value'] }}<br/>
            @endforeach
        </div>
        <div class="well well-small">
            <h5>Occasion</h5>
            @foreach($occasionArray as $occasion)
                <input class="occasion" type="checkbox" style="margin-top: -3px" name="occasion[]" id="{{ $occasion['filter_value'] }}" value="{{ $occasion['filter_value'] }}">
                {{ $occasion['filter_value'] }}<br/>
            @endforeach
        </div>
    @endif
    <br/>
    <div class="thumbnail">
        <img src="{{asset('images/frontImages/payment_methods.png')}}" title="Payment Methods" alt="Payments Methods">
        <div class="caption">
            <h5>Payment Methods</h5>
        </div>
    </div>
</div>
