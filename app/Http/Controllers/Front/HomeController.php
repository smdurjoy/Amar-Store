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
        // Get featured products
        $featuredItemsCount = Product::where('is_featured', 'Yes')->where('status', 1)->count();
        $featuredItems = Product::where('is_featured', 'Yes')->where('status', 1)->select('id', 'product_name', 'product_image', 'product_price')->get()->toArray();
        $featuredItemsChunk = array_chunk($featuredItems, 4);
        // dd($featuredItemsChunk); die;

        // Get latest products
        $latestProducts = Product::where('status', 1)->orderBy('id', 'desc')->with('brand')->select('id', 'product_name', 'product_image', 'product_price', 'brand_id')->limit(6)->get()->toArray();
//         echo '<pre>'; print_r($latestProducts); die;

        return view('front.index')->with(compact('page_name', 'featuredItemsCount', 'featuredItemsChunk', 'latestProducts'));
    }
}
