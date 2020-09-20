@extends('layouts.front.front')

@section('content')
<div class="span9">
    <div class="well well-small">
        <h4>Featured Products <small class="pull-right">{{$featuredItemsCount}} featured products</small></h4>
        <div class="row-fluid">
            <div id="featured" @if($featuredItemsCount > 4) class="carousel slide" @endif>
                <div class="carousel-inner">
                    @foreach($featuredItemsChunk as $key => $featuredItem)
                        <div class="item @if($key == 1) active @endif">
                            <ul class="thumbnails">
                                @foreach($featuredItem as $item)
                                <li class="span3">
                                    <div class="thumbnail">
                                        <i class="tag"></i>
                                        <a href="product_details.html">
                                            <?php $productImagePath = 'images/productImages/small/'.$item['product_image'] ?>
                                            @if(!empty($item['product_image']) && file_exists($productImagePath))
                                                <img src="{{ asset($productImagePath) }}" alt="">
                                            @else
                                                <img src="{{ asset('images/productImages/small/smallDummyImg.png') }}" alt="">
                                            @endif
                                        </a>
                                        <div class="caption">
                                            <h5>{{$item['product_name']}}</h5>
                                            <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">Tk.{{$item['product_price']}}</span></h4>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>  
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <h4>Latest Products </h4> 
    <ul class="thumbnails">
    @foreach($latestProducts as $latestProduct) 
        <li class="span3">
            <div class="thumbnail">
                <a  href="product_details.html">
                    <?php $productImagePath = 'images/productImages/small/'.$item['product_image'] ?>
                    @if(!empty($latestProduct['product_image']) && file_exists($productImagePath))
                        <img class="featuredProductImage" src="{{ asset($productImagePath) }}" alt="">
                    @else
                        <img class="featuredProductImage" src="{{ asset('images/productImages/small/smallDummyImg.png') }}" alt="">
                    @endif
                </a>
                <div class="caption">
                    <h5>{{ $latestProduct['product_name'] }}</h5> 
                    <p>{{ $latestProduct['product_code'] }}</p>
                    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Tk.{{ $latestProduct['product_price'] }}</a></h4>
                </div>
            </div>
        </li>
    @endforeach
    </ul>
</div>
@endsection