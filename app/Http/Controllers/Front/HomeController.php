<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use App\Product;

class HomeController extends Controller
{
    function index() {
        $featuredItemsCount = Product::where('is_featured', 'Yes')->count(); 
        $featuredItems = Product::where('is_featured', 'Yes')->select('product_name', 'product_image', 'product_price')->get()->toArray(); 
        $featuredItemsChunk = array_chunk($featuredItems, 4);
        // dd($featuredItemsChunk); die;
        $page_name = 'index';
        return view('front.index')->with(compact('page_name', 'featuredItemsCount', 'featuredItemsChunk'));
    }
}
