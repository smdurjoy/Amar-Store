@extends('layouts.front.front')

@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
        <li class="active"><?php echo $categoryDetails['breadcrumbs']?></li>
    </ul>
    <h3> {{ $categoryDetails['categoryDetails']['category_name'] }} <small class="pull-right"> {{ count($categoryProducts) }} products are available </small></h3>
    <hr class="soft"/>
    <p>
        {{ $categoryDetails['categoryDetails']['description'] }}
    </p>
    <hr class="soft"/> 
    <form class="form-horizontal span6" name="sortProducts" id="sortProducts">
        <div class="control-group">
            <label class="control-label alignL">Sort By </label>
            <select name="sort" id="sort">
                <option value="">Select</option>
                <option value="latest_products" @if(isset($_GET['sort']) && $_GET['sort'] == 'latest_products') selected class="sortSelected" @endif>Latest Products</option>
                <option value="price_lowset" @if(isset($_GET['sort']) && $_GET['sort'] == 'price_lowset') selected class="sortSelected" @endif>Lowest price first</option>
                <option value="price_highest" @if(isset($_GET['sort']) && $_GET['sort'] == 'price_highest') selected class="sortSelected" @endif>Highest price first</option>
                <option value="products_a_z" @if(isset($_GET['sort']) && $_GET['sort'] == 'products_a_z') selected class="sortSelected" @endif>Product name A - Z</option>
                <option value="products_z_a" @if(isset($_GET['sort']) && $_GET['sort'] == 'products_z_a') selected class="sortSelected" @endif>Product name Z - A</option>
            </select>
        </div>
    </form>
    
    <div id="myTab" class="pull-right">
        <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
        <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
    </div>
    <br class="clr"/>
    <div class="tab-content">
        <div class="tab-pane" id="listView">
            @foreach($categoryProducts as $product)
                <div class="row">
                    <div class="span2">
                        <?php $productImagePath = 'images/productImages/small/'.$product['product_image'] ?>
                        @if(!empty($product['product_image']) && file_exists($productImagePath))
                            <img class="listingPageListViewImage" src="{{ asset($productImagePath) }}" alt="">
                        @else
                            <img class="listingPageListViewImage" src="{{ asset('images/productImages/small/smallDummyImg.png') }}" alt="">
                        @endif
                    </div>
                    <div class="span4">
                        <h3>{{ $product['product_name'] }}</h3>
                        <hr class="soft"/>
                        <h5>Brand: {{ $product['brand']['name'] }}</h5>
                        <p>{{ $product['product_description'] }}</p>
                        <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
                        <br class="clr"/>
                    </div>
                    <div class="span3 alignR">
                        <form class="form-horizontal qtyFrm">
                            <h3>Tk.{{ $product['product_price'] }}</h3>
                            <label class="checkbox">
                                <input type="checkbox">  Adds product to compare
                            </label><br/>
                            
                            <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                            <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
                            
                        </form>
                    </div>
                </div>
                <hr class="soft"/>
            @endforeach
        </div>
        <div class="tab-pane  active" id="blockView">
            <ul class="thumbnails">
            @foreach($categoryProducts as $product)
                <li class="span3">
                    <div class="thumbnail">
                        <a href="product_details.html">
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
                            <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Tk.{{ $product['product_price'] }}</a></h4>
                        </div>
                    </div>
                </li>
            @endforeach
            </ul>
            <hr class="soft"/>
        </div>
    </div>
    <a href="compare.html" class="btn btn-large pull-right">Compare Product</a>
    <div class="pagination">
        @if(isset($_GET['sort']) && !empty($_GET['sort']))
            {{ $categoryProducts->appends(['sort' => $_GET['sort']])->links() }}
        @else
            {{ $categoryProducts->links() }}
        @endif
    </div>
    <br class="clr"/>
</div>
@endsection