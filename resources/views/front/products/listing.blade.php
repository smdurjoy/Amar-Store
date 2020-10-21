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
    <input type="hidden" id="url" value="{{ $url }}"/>
    <form class="form-horizontal span6" name="sortProducts" id="sortProducts">
        <div class="control-group">
            <label class="control-label alignL">Sort By</label>
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

    <br class="clr"/>
    <div class="tab-content" id="filter_products">
        @include('front.products.ajaxProductView')
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
