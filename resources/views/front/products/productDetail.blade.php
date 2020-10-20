@extends('layouts.front.front')

@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li><a href="products.html">Products</a> <span class="divider">/</span></li>
            <li class="active">Product Details</li>
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
                    <!--
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                    -->
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
                <h3>{{ $productDetails['product_name'] }}</h3>
                <small>- {{ $productDetails['brand']['name'] }}</small>
                <hr class="soft"/>
                <small>{{ $totalStock }} items in stock</small>
                <form class="form-horizontal qtyFrm">
                    <div class="control-group">
                        <h4>Tk.{{ $productDetails['product_price'] }}</h4>
                        <select class="span2 pull-left">
                            <option>Select Size</option>
                            @foreach($productDetails['attributes'] as $attribute)
                                <option>{{ $attribute['size'] }}</option>
                            @endforeach
                        </select>
                        <input type="number" class="span1" placeholder="Qty."/>
                        <button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button>
                    </div>
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
                    <br class="clr"/>
                    <hr class="soft"/>
                    <div class="tab-content">
                        <div class="tab-pane" id="listView">
                            <div class="row">
                                <div class="span2">
                                    <img src="themes/images/products/4.jpg" alt=""/>
                                </div>
                                <div class="span4">
                                    <h3>New | Available</h3>
                                    <hr class="soft"/>
                                    <h5>Product Name </h5>
                                    <p>
                                        Nowadays the lingerie industry is one of the most successful business spheres.We always stay in touch with the latest fashion tendencies -
                                        that is why our goods are so popular..
                                    </p>
                                    <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
                                    <br class="clr"/>
                                </div>
                                <div class="span3 alignR">
                                    <form class="form-horizontal qtyFrm">
                                        <h3> Rs.1000</h3>
                                        <label class="checkbox">
                                            <input type="checkbox">  Adds product to compair
                                        </label><br/>
                                        <div class="btn-group">
                                            <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                                            <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr class="soft"/>
                            <div class="row">
                                <div class="span2">
                                    <img src="themes/images/products/5.jpg" alt=""/>
                                </div>
                                <div class="span4">
                                    <h3>New | Available</h3>
                                    <hr class="soft"/>
                                    <h5>Product Name </h5>
                                    <p>
                                        Nowadays the lingerie industry is one of the most successful business spheres.We always stay in touch with the latest fashion tendencies -
                                        that is why our goods are so popular..
                                    </p>
                                    <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
                                    <br class="clr"/>
                                </div>
                                <div class="span3 alignR">
                                    <form class="form-horizontal qtyFrm">
                                        <h3> Rs.1000</h3>
                                        <label class="checkbox">
                                            <input type="checkbox">  Adds product to compair
                                        </label><br/>
                                        <div class="btn-group">
                                            <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                                            <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr class="soft"/>
                            <div class="row">
                                <div class="span2">
                                    <img src="themes/images/products/6.jpg" alt=""/>
                                </div>
                                <div class="span4">
                                    <h3>New | Available</h3>
                                    <hr class="soft"/>
                                    <h5>Product Name </h5>
                                    <p>
                                        Nowadays the lingerie industry is one of the most successful business spheres.We always stay in touch with the latest fashion tendencies -
                                        that is why our goods are so popular..
                                    </p>
                                    <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
                                    <br class="clr"/>
                                </div>
                                <div class="span3 alignR">
                                    <form class="form-horizontal qtyFrm">
                                        <h3> Rs.1000</h3>
                                        <label class="checkbox">
                                            <input type="checkbox">  Adds product to compair
                                        </label><br/>
                                        <div class="btn-group">
                                            <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                                            <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr class="soft"/>
                            <div class="row">
                                <div class="span2">
                                    <img src="themes/images/products/7.jpg" alt=""/>
                                </div>
                                <div class="span4">
                                    <h3>New | Available</h3>
                                    <hr class="soft"/>
                                    <h5>Product Name </h5>
                                    <p>
                                        Nowadays the lingerie industry is one of the most successful business spheres.We always stay in touch with the latest fashion tendencies -
                                        that is why our goods are so popular..
                                    </p>
                                    <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
                                    <br class="clr"/>
                                </div>
                                <div class="span3 alignR">
                                    <form class="form-horizontal qtyFrm">
                                        <h3> Rs.1000</h3>
                                        <label class="checkbox">
                                            <input type="checkbox">  Adds product to compair
                                        </label><br/>
                                        <div class="btn-group">
                                            <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                                            <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <hr class="soft"/>
                            <div class="row">
                                <div class="span2">
                                    <img src="themes/images/products/8.jpg" alt=""/>
                                </div>
                                <div class="span4">
                                    <h3>New | Available</h3>
                                    <hr class="soft"/>
                                    <h5>Product Name </h5>
                                    <p>
                                        Nowadays the lingerie industry is one of the most successful business spheres.We always stay in touch with the latest fashion tendencies -
                                        that is why our goods are so popular..
                                    </p>
                                    <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
                                    <br class="clr"/>
                                </div>
                                <div class="span3 alignR">
                                    <form class="form-horizontal qtyFrm">
                                        <h3> Rs.1000</h3>
                                        <label class="checkbox">
                                            <input type="checkbox">  Adds product to compair
                                        </label><br/>
                                        <div class="btn-group">
                                            <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                                            <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr class="soft"/>
                            <div class="row">
                                <div class="span2">
                                    <img src="themes/images/products/9.jpg" alt=""/>
                                </div>
                                <div class="span4">
                                    <h3>New | Available</h3>
                                    <hr class="soft"/>
                                    <h5>Product Name </h5>
                                    <p>
                                        Nowadays the lingerie industry is one of the most successful business spheres.We always stay in touch with the latest fashion tendencies -
                                        that is why our goods are so popular..
                                    </p>
                                    <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
                                    <br class="clr"/>
                                </div>
                                <div class="span3 alignR">
                                    <form class="form-horizontal qtyFrm">
                                        <h3> Rs.1000</h3>
                                        <label class="checkbox">
                                            <input type="checkbox">  Adds product to compair
                                        </label><br/>
                                        <div class="btn-group">
                                            <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                                            <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr class="soft"/>
                        </div>
                        <div class="tab-pane active" id="blockView">
                            <ul class="thumbnails">
                                <li class="span3">
                                    <div class="thumbnail">
                                        <a href="product_details.html"><img src="themes/images/products/10.jpg" alt=""/></a>
                                        <div class="caption">
                                            <h5>Casual T-Shirt</h5>
                                            <p>
                                                Lorem Ipsum is simply dummy text.
                                            </p>
                                            <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                                        </div>
                                    </div>
                                </li>
                                <li class="span3">
                                    <div class="thumbnail">
                                        <a href="product_details.html"><img src="themes/images/products/11.jpg" alt=""/></a>
                                        <div class="caption">
                                            <h5>Casual T-Shirt</h5>
                                            <p>
                                                Lorem Ipsum is simply dummy text.
                                            </p>
                                            <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                                        </div>
                                    </div>
                                </li>
                                <li class="span3">
                                    <div class="thumbnail">
                                        <a href="product_details.html"><img src="themes/images/products/12.jpg" alt=""/></a>
                                        <div class="caption">
                                            <h5>Casual T-Shirt</h5>
                                            <p>
                                                Lorem Ipsum is simply dummy text.
                                            </p>
                                            <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                                        </div>
                                    </div>
                                </li>
                                <li class="span3">
                                    <div class="thumbnail">
                                        <a href="product_details.html"><img src="themes/images/products/13.jpg" alt=""/></a>
                                        <div class="caption">
                                            <h5>Casual T-Shirt</h5>
                                            <p>
                                                Lorem Ipsum is simply dummy text.
                                            </p>
                                            <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                                        </div>
                                    </div>
                                </li>
                                <li class="span3">
                                    <div class="thumbnail">
                                        <a href="product_details.html"><img src="themes/images/products/1.jpg" alt=""/></a>
                                        <div class="caption">
                                            <h5>Casual T-Shirt</h5>
                                            <p>
                                                Lorem Ipsum is simply dummy text.
                                            </p>
                                            <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                                        </div>
                                    </div>
                                </li>
                                <li class="span3">
                                    <div class="thumbnail">
                                        <a href="product_details.html"><img src="themes/images/products/2.jpg" alt=""/></a>
                                        <div class="caption">
                                            <h5>Casual T-Shirt</h5>
                                            <p>
                                                Lorem Ipsum is simply dummy text.
                                            </p>
                                            <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                                        </div>
                                    </div>
                                </li>
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
