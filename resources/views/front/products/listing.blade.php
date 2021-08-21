<?php
use App\Section;
use Illuminate\Support\Facades\Auth;

$sections = Section::section();
?>

@extends('layouts.front.front')

@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active"><?php echo $categoryDetails['breadcrumbs']?></li>
            </ul>
        </div>
    </div>
</div>
<!-- Begin Li's Content Wraper Area -->
<div class="content-wraper pt-60 pb-60 pt-sm-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-1 order-lg-2" style="margin-top:-4rem">
                <!-- shop-top-bar start -->
                <div class="shop-top-bar mt-30">
                    <div class="shop-bar-inner">
                        <div class="product-view-mode">
                            <!-- shop-item-filter-list start -->
                            <ul class="nav shop-item-filter-list" role="tablist">
                                <li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a></li>
                            </ul>
                            <!-- shop-item-filter-list end -->  
                        </div>
                        <div class="toolbar-amount">
                            <span>Showing {{ $categoryProducts->firstItem() }} to {{ $categoryProducts->count() }} of {{ $categoryProducts->total() }}</span>
                        </div>
                    </div>
                    <!-- product-select-box start -->
                    <div class="product-select-box">
                        <input type="hidden" id="url" value="{{ $url }}"/>
                        <form class="form-horizontal span6" name="sortProducts" id="sortProducts">
                            <div class="product-short">
                                <p>Sort By:</p>
                                <select class="nice-select" name="sort" id="sort">
                                    <option value="">Select</option>
                                    <option value="latest_products" @if(isset($_GET['sort']) && $_GET['sort'] == 'latest_products') selected class="sortSelected" @endif>Latest Products</option>
                                    <option value="price_lowset" @if(isset($_GET['sort']) && $_GET['sort'] == 'price_lowset') selected class="sortSelected" @endif>Lowest price first</option>
                                    <option value="price_highest" @if(isset($_GET['sort']) && $_GET['sort'] == 'price_highest') selected class="sortSelected" @endif>Highest price first</option>
                                    <option value="products_a_z" @if(isset($_GET['sort']) && $_GET['sort'] == 'products_a_z') selected class="sortSelected" @endif>Product name A - Z</option>
                                    <option value="products_z_a" @if(isset($_GET['sort']) && $_GET['sort'] == 'products_z_a') selected class="sortSelected" @endif>Product name Z - A</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <!-- product-select-box end -->
                </div>
                <!-- shop-top-bar end -->
                <!-- shop-products-wrapper start -->
                <div class="shop-products-wrapper">
                    <div class="tab-content">
                        <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                            <div class="product-area shop-product-area" id="filter_products">
                                @include('front.products.ajaxProductView')
                            </div>
                        </div>
                        <div class="paginatoin-area">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 pt-xs-15">
                                    <p>Showing {{ $categoryProducts->firstItem() }}-{{ $categoryProducts->count() }} of {{ $categoryProducts->total() }} item(s)</p>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <ul class="pagination-box pt-xs-20 pb-xs-15">
                                        <li>
                                            <a href="{{ $categoryProducts->previousPageUrl() }}" class="Previous"><i class="fa fa-chevron-left"></i> Previous</a>
                                        </li>
                                        @if(isset($_GET['sort']) && !empty($_GET['sort']))
                                            @for ($i=1; $i<=$categoryProducts->lastPage(); $i++)
                                                <li class="{{ ($categoryProducts->currentPage() == $i) ? ' active' : '' }}">
                                                    <a href="{{ $categoryProducts->appends(['sort' => $_GET['sort']])->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                        @else
                                            @for ($i=1; $i<=$categoryProducts->lastPage(); $i++)
                                                <li class="{{ ($categoryProducts->currentPage() == $i) ? ' active' : '' }}">
                                                    <a href="{{ $categoryProducts->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                        @endif
                                        <li>
                                            <a href="{{ $categoryProducts->nextPageUrl() }}" class="Next"> Next<i class="fa fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- shop-products-wrapper end -->
            </div>
            <div class="col-lg-3 order-2 order-lg-1" style="margin-top:-2.1rem">
                <!--sidebar-categores-box start  -->    
                <div class="sidebar-categores-box mt-sm-30 mt-xs-30">
                    <div class="sidebar-title">
                        <h2>Categories</h2>
                    </div>
                    <!-- category-sub-menu start -->
                    <div class="category-sub-menu">
                        <ul>
                            @foreach($sections as $section)
                                @if(count($section['categories']) > 0)
                                    <li class="has-sub"><a href="#">{{$section['name']}}</a>
                                    @foreach($section['categories'] as $category)
                                        <ul>
                                            <li @if(!empty($category['sub_categories'])) class="has-sub" @endif><a href="{{ url($category['url']) }} ">{{ $category['category_name'] }}</a>
                                            @if(!empty($category['sub_categories']))
                                                @foreach($category['sub_categories'] as $subCategories)
                                                    <ul>
                                                        <li><a href="{{ url($subCategories['url']) }}">{{$subCategories['category_name']}}</a></li>
                                                    </ul>
                                                @endforeach
                                            @endif
                                        </ul>
                                    @endforeach
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <!-- category-sub-menu end -->
                </div>
                <!--sidebar-categores-box end  -->
                <!--sidebar-categores-box start  -->
                <div class="sidebar-categores-box">
                    <div class="sidebar-title">
                        <h2>Filter By</h2>
                    </div>
                    <!-- btn-clear-all start -->
                    <button class="btn-clear-all mb-sm-30 mb-xs-30">Clear all</button>
                    <!-- btn-clear-all end -->
                    <!-- filter-sub-area start -->
                    <div class="filter-sub-area">
                        <h5 class="filter-sub-titel">Fabric</h5>
                        <div class="categori-checkbox">
                            <ul>
                                @foreach($fabricArray as $fabric)
                                    <li>
                                        <input class="fabric" type="checkbox" name="fabric[]" id="{{ $fabric['filter_value'] }}" value="{{ $fabric['filter_value'] }}">
                                        <a><label for="{{ $fabric['filter_value'] }}">{{ $fabric['filter_value'] }}</label></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- filter-sub-area end -->
                    <!-- filter-sub-area start -->
                    <div class="filter-sub-area pt-sm-10 pt-xs-10">
                        <h5 class="filter-sub-titel">Sleeve</h5>
                        <div class="categori-checkbox">
                            <ul>
                                @foreach($sleeveArray as $sleeve)
                                    <li>
                                        <input class="sleeve" type="checkbox" name="sleeve[]" id="{{ $sleeve['filter_value'] }}" value="{{ $sleeve['filter_value'] }}">
                                        <a><label for="{{ $sleeve['filter_value'] }}">{{ $sleeve['filter_value'] }}</label></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        </div>
                    <!-- filter-sub-area end -->
                    <!-- filter-sub-area start -->
                    <div class="filter-sub-area pt-sm-10 pt-xs-10">
                        <h5 class="filter-sub-titel">Pattern</h5>
                        <div class="size-checkbox">
                            <ul>
                                @foreach($patternArray as $pattern)
                                    <li>
                                        <input class="pattern" type="checkbox" name="pattern[]" id="{{ $pattern['filter_value'] }}" value="{{ $pattern['filter_value'] }}">
                                        <a><label for="{{ $pattern['filter_value'] }}">{{ $pattern['filter_value'] }}</label></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- filter-sub-area end -->
                    <!-- filter-sub-area start -->
                    <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
                        <h5 class="filter-sub-titel">Fit</h5>
                        <div class="categori-checkbox">
                            <ul>
                                @foreach($fitArray as $fit)
                                    <li>
                                        <input class="fit" type="checkbox" name="fit[]" id="{{ $fit['filter_value'] }}" value="{{ $fit['filter_value'] }}">
                                        <a><label for="{{ $fit['filter_value'] }}">{{ $fit['filter_value'] }}</label></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- filter-sub-area end -->
                    <!-- filter-sub-area start -->
                    <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
                        <h5 class="filter-sub-titel">Occasion</h5>
                        <div class="categori-checkbox">
                            <ul>
                                @foreach($occasionArray as $occasion)
                                    <li>
                                        <input class="occasion" type="checkbox" name="occasion[]" id="{{ $occasion['filter_value'] }}" value="{{ $occasion['filter_value'] }}">
                                        <a><label for="{{ $occasion['filter_value'] }}">{{ $occasion['filter_value'] }}</label></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- filter-sub-area end -->
                </div>
                <!--sidebar-categores-box end  -->
            </div>
        </div>
    </div>
</div>
<!-- Content Wraper Area End Here -->
@endsection

