<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use App\Product;

class HomeController extends Controller
{
    function index() {
        $page_name = 'index';
        $featuredItems = Product::where('is_featured', 'Yes')->where('status', 1)->with('brand')->select('id', 'brand_id', 'product_name', 'product_image', 'product_price', 'product_discount', 'created_at')->get()->toArray();
        $latestProducts = Product::where('status', 1)->orderBy('id', 'desc')->with('brand')->select('id', 'brand_id', 'product_name', 'product_image', 'product_price', 'product_discount')->limit(6)->get()->toArray();
        return view('front.index')->with(compact('page_name', 'featuredItems', 'latestProducts'));
    }
}
