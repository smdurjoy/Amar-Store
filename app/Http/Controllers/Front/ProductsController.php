<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\ProductFilter;
use Illuminate\Http\Request;
use App\Category;
use App\Product;

class ProductsController extends Controller
{
    function listing($url, Request $request) {
        if($request->ajax()) {
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            $data = $request->all();
//            echo '<pre>'; print_r($data); die;
            $url = $data['url'];

            if($categoryCount > 0) {
                $categoryDetails = Category::categoryDetails($url);
                $categoryProducts = Product::with(['brand' => function($query) {
                    $query->select('id', 'name');
                }])->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);

                // If fabric option is selected
                if(isset($data['fabric']) && !empty($data['fabric'])) {
                    $categoryProducts->whereIn('products.fabric', $data['fabric']);
                }

                // If sleeve option is selected
                if(isset($data['sleeve']) && !empty($data['sleeve'])) {
                    $categoryProducts->whereIn('products.sleeve', $data['sleeve']);
                }

                // If pattern option is selected
                if(isset($data['pattern']) && !empty($data['pattern'])) {
                    $categoryProducts->whereIn('products.pattern', $data['pattern']);
                }

                // If fit option is selected
                if(isset($data['fit']) && !empty($data['fit'])) {
                    $categoryProducts->whereIn('products.fit', $data['fit']);
                }

                // If occasion option is selected
                if(isset($data['occasion']) && !empty($data['occasion'])) {
                    $categoryProducts->whereIn('products.occasion', $data['occasion']);
                }

                    // If sort option is selected
                if(isset($data['sort']) && !empty($data['sort'])) {
                    if($data['sort'] == 'latest_products') {
                        $categoryProducts->orderBy('id', 'desc');
                    }
                    else if($data['sort'] == 'products_a_z') {
                        $categoryProducts->orderBy('product_name', 'asc');
                    }
                    else if($data['sort'] == 'products_z_a') {
                        $categoryProducts->orderBy('product_name', 'desc');
                    }
                    else if($data['sort'] == 'price_lowset') {
                        $categoryProducts->orderBy('product_price', 'asc');
                    }
                    else if($data['sort'] == 'price_highest') {
                        $categoryProducts->orderBy('product_price', 'desc');
                    }
                }
                else {
                    $categoryProducts->orderBy('id', 'desc');
                }

                $categoryProducts = $categoryProducts->paginate(30);

                return view('front.products.ajaxProductView')->with(compact('categoryDetails', 'categoryProducts', 'url'));
            }
        } else {
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();

            if($categoryCount > 0) {
                $categoryDetails = Category::categoryDetails($url);
                // echo '<pre>'; print_r($categoryDetails); die;
                $categoryProducts = Product::with(['brand' => function($query) {
                    $query->select('id', 'name');
                }])->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);
                // echo '<pre>'; print_r($categoryProducts); die;

                // If sort option selected by user
                if(isset($_GET['sort']) && !empty($_GET['sort'])) {
                    if($_GET['sort'] == 'latest_products') {
                        $categoryProducts->orderBy('id', 'desc');
                    }
                    else if($_GET['sort'] == 'products_a_z') {
                        $categoryProducts->orderBy('product_name', 'asc');
                    }
                    else if($_GET['sort'] == 'products_z_a') {
                        $categoryProducts->orderBy('product_name', 'desc');
                    }
                    else if($_GET['sort'] == 'price_lowset') {
                        $categoryProducts->orderBy('product_price', 'asc');
                    }
                    else if($_GET['sort'] == 'price_highest') {
                        $categoryProducts->orderBy('product_price', 'desc');
                    }
                }
                else {
                    $categoryProducts->orderBy('id', 'desc');
                }

                $categoryProducts = $categoryProducts->paginate(30);

                // Product filters
                $fabricArray = ProductFilter::where('filter_name', 'fabric')->get();
                $sleeveArray = ProductFilter::where('filter_name', 'sleeve')->get();
                $patternArray = ProductFilter::where('filter_name', 'pattern')->get();
                $fitArray = ProductFilter::where('filter_name', 'fit')->get();
                $occasionArray = ProductFilter::where('filter_name', 'occasion')->get();

                $pageName = 'listing';
                return view('front.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'url', 'fabricArray', 'sleeveArray', 'patternArray', 'fitArray', 'occasionArray', 'pageName'));
            } else {
                abort(404);
            }
        }
    }
}
