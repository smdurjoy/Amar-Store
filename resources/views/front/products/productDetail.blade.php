@extends('layouts.front.front')

@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
            <li><a href="{{ url('/'.$productDetails['category']['url']) }}">{{ $productDetails['category']['category_name'] }}</a> <span class="divider">/</span></li>
            <li class="active">{{ $productDetails['product_name'] }}</li>
        </ul>
        <div class="row">
            <div id="gallery" class="span3">
                <a href="{{ asset('images/productImages/medium/'.$productDetails['product_image']) }}" title="Blue Casual T-Shirt">
                    <img src="{{ asset('images/productImages/large/'.$productDetails['product_image']) }}" style="width:100%" alt="Blue Casual T-Shirt"/>
                </a>
                <div id="differentview" class="moreOptopm carousel slide">
                    <div class="carousel-inner">
                        <div class="item active">
                            @foreach($productDetails['images'] as $image)
                                <a href="{{ asset('images/productImages/medium/'.$image['image']) }}">
                                <img style="width:29%" src="{{ asset('images/productImages/medium/'.$image['image']) }}" alt=""/></a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="btn-toolbar">
                    <div class="btn-group">
                        <span class="btn"><i class="icon-envelope"></i></span>
                        <span class="btn" ><i class="icon-print"></i></span>
                        <span class="btn" ><i class="icon-zoom-in"></i></span>
                        <span class="btn" ><i class="icon-star"></i></span>
                        <span class="btn" ><i class=" icon-thumbs-up"></i></span>
                        <span class="btn" ><i class="icon-thumbs-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="span6">
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
                <h3>{{ $productDetails['product_name'] }}</h3>
                <small>- {{ $productDetails['brand']['name'] }}</small>
                <hr class="soft"/>
                <small>{{ $totalStock }} items in stock</small>
                <form action="{{ url('add-to-cart') }}" method="post" class="form-horizontal qtyFrm">@csrf
                    <div class="control-group">
                        <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
                        <h4 class="productPrice">Tk.{{ $productDetails['product_price'] }}</h4>
                        <select name="size" class="span2 pull-left" id="getPrice" data-id="{{ $productDetails['id'] }}" required>
                            <option value="">Select Size</option>
                            @foreach($productDetails['attributes'] as $attribute)
                                <option value="{{ $attribute['size'] }}">{{ $attribute['size'] }}</option>
                            @endforeach
                        </select>
                        <input name="quantity" type="number" class="span1" placeholder="Qty." required/>
                        <button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button>
                    </div>
                </form>

            <hr class="soft clr"/>
            <p class="span6">
                {{ $productDetails['product_description'] }}

            </p>
            <a class="btn btn-small pull-right" href="#detail">More Details</a>
            <br class="clr"/>
            <a href="#" name="detail"></a>
            <hr class="soft"/>
        </div>

        <div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
                <li><a href="#profile" data-toggle="tab">Related Products</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <h4>Product Information</h4>
                    <table class="table table-bordered">
                        <tbody>
                        <tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
                        <tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2">{{ $productDetails['brand']['name'] }}</td></tr>
                        <tr class="techSpecRow"><td class="techSpecTD1">Code:</td><td class="techSpecTD2">{{ $productDetails['product_code'] }}</td></tr>
                        <tr class="techSpecRow"><td class="techSpecTD1">Color:</td><td class="techSpecTD2">{{ $productDetails['product_color'] }}</td></tr>
                        @if(!empty($productDetails['fabric']))
                            <tr class="techSpecRow"><td class="techSpecTD1">Fabric:</td><td class="techSpecTD2">{{ $productDetails['fabric'] }}</td></tr>
                        @endif
                        @if(!empty($productDetails['pattern']))
                        <tr class="techSpecRow"><td class="techSpecTD1">Pattern:</td><td class="techSpecTD2">{{ $productDetails['pattern'] }}</td></tr>
                        @endif
                        @if(!empty($productDetails['sleeve']))
                        <tr class="techSpecRow"><td class="techSpecTD1">Sleeve:</td><td class="techSpecTD2">{{ $productDetails['sleeve'] }}</td></tr>
                        @endif
                        @if(!empty($productDetails['fit']))
                        <tr class="techSpecRow"><td class="techSpecTD1">Fit:</td><td class="techSpecTD2">{{ $productDetails['fit'] }}</td></tr>
                        @endif
                        @if(!empty($productDetails['occasion']))
                        <tr class="techSpecRow"><td class="techSpecTD1">Occasion:</td><td class="techSpecTD2">{{ $productDetails['occasion'] }}</td></tr>
                        @endif
                        </tbody>
                    </table>

                    @if(!empty($productDetails['wash_care']))
                        <h5>Washcare</h5>
                        <p>{{ $productDetails['wash_care'] }}</p>
                    @endif
                    <h5>Disclaimer</h5>
                    <p>
                        There may be a slight color variation between the image shown and original product.
                    </p>
                </div>
                <div class="tab-pane fade" id="profile">
                    <div id="myTab" class="pull-right">
                        <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
                        <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
                    </div>
                    <h4>Related Products</h4>
                    <br class="clr"/>
                    <hr class="soft"/>
                    <div class="tab-content">
                        <div class="tab-pane" id="listView">
                            @foreach($relatedProducts as $relatedProduct)
                                <div class="row">
                                    <div class="span2">
                                        <?php $productImagePath = 'images/productImages/small/'.$relatedProduct['product_image'] ?>
                                        @if(!empty($relatedProduct['product_image']) && file_exists($productImagePath))
                                            <img style="width: 180px; height: 180px" class="listingPageProductImage" src="{{ asset($productImagePath) }}" alt="">
                                        @else
                                            <img class="listingPageProductImage" src="{{ asset('images/productImages/small/smallDummyImg.png') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="span4">
                                        <h3>{{ $relatedProduct['product_name'] }}</h3>
                                        <hr class="soft"/>
                                        <h5>{{ $relatedProduct['brand']['name'] }}</h5>
                                        <p>{{ $relatedProduct['product_description'] }}</p>
                                        <a class="btn btn-small pull-right" href="{{ url('product/'.$relatedProduct['id'].'/'.$relatedProduct['product_name']) }}">View Details</a>
                                        <br class="clr"/>
                                    </div>
                                    <div class="span3 alignR">
                                        <form class="form-horizontal qtyFrm">
                                            <h3>Tk.{{ $relatedProduct['product_price'] }}</h3>
                                            <label class="checkbox">
                                                <input type="checkbox">  Adds product to compare
                                            </label><br/>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                                                <a href="#" class="btn btn-large"><i class="icon-zoom-in"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <hr class="soft"/>
                            @endforeach
                        </div>
                        <div class="tab-pane active" id="blockView">
                            <ul class="thumbnails">
                                @foreach($relatedProducts as $relatedProduct)
                                    <li class="span3">
                                    <div class="thumbnail">
                                        <a href="{{ url('product/'.$relatedProduct['id'].'/'.$relatedProduct['product_name']) }}">
                                            <?php $productImagePath = 'images/productImages/small/'.$relatedProduct['product_image'] ?>
                                            @if(!empty($relatedProduct['product_image']) && file_exists($productImagePath))
                                                <img style="width: 180px; height: 180px" class="listingPageProductImage" src="{{ asset($productImagePath) }}" alt="">
                                            @else
                                                <img class="listingPageProductImage" src="{{ asset('images/productImages/small/smallDummyImg.png') }}" alt="">
                                            @endif
                                        </a>
                                        <div class="caption">
                                            <h5>{{ $relatedProduct['product_name'] }}</h5>
                                            <p>{{ $relatedProduct['brand']['name'] }}</p>
                                            <p>{{ $relatedProduct['product_description'] }}</p>
                                            <h4 style="text-align:center"><a class="btn" href="#"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Tk.{{ $relatedProduct['product_price'] }}</a></h4>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <hr class="soft"/>
                        </div>
                    </div>
                    <br class="clr">
                </div>
            </div>
        </div>
    </div>
@endsection
