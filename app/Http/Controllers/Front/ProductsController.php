<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;

class ProductsController extends Controller
{
    function listing($url, Request $request) {
        if($request->ajax()) {
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            $data = $request->all();
            $url = $data['url'];

            if($categoryCount > 0) {
                $categoryDetails = Category::categoryDetails($url);
                $categoryProducts = Product::with(['brand' => function($query) {
                    $query->select('id', 'name');
                }])->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);

                // If sort option selected by user
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

                return view('front.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'url'));
            } else {
                abort(404);
            }
        }
    }
}
