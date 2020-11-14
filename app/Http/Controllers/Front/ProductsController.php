<?php

namespace App\Http\Controllers\Front;

use App\Cart;
use App\Http\Controllers\Controller;
use App\ProductFilter;
use App\ProductsAttribute;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    function listing(Request $request) {
        Paginator::useBootstrap();
        if($request->ajax()) {
            $data = $request->all();
            $url = $data['url'];
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
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

                $categoryProducts = $categoryProducts->paginate(9);

                return view('front.products.ajaxProductView')->with(compact('categoryDetails', 'categoryProducts', 'url'));
            }
        } else {
            $url = Route::getFacadeRoot()->current()->uri();
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

                $categoryProducts = $categoryProducts->paginate(9);

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

    function productDetail($id, $name) {
        $productDetails = Product::with(['category', 'brand', 'attributes' => function($query) {
            $query->where('status', 1);
        }, 'images'])->find($id)->toArray();
//        echo '<pre>'; print_r($productDetails); die;
        $totalStock = ProductsAttribute::where('product_id', $id)->sum('stock');
        $relatedProducts = Product::with('brand')->where('category_id', $productDetails['category']['id'])->where('id', '!=', $id)->limit(3)->inRandomOrder()->get()->toArray();
//        echo '<pre>'; print_r($relatedProducts); die;
        return view('front.products.productDetail')->with(compact('productDetails', 'totalStock', 'relatedProducts'));
    }

    function getProductPrice(Request $request) {
        if ($request->ajax()) {
            $data = $request->all();
            $getDiscountedAttrPrice = Product::getDiscountedAttrPrice($data['id'], $data['size']);
            // $getProductPrice = ProductsAttribute::where(['product_id' => $data['id'], 'size' => $data['size']])->first();
            return $getDiscountedAttrPrice;
        }
    }

    function addToCart(Request $request) {
        $data = $request->all();

        // Check product stock is available or not
        $getProductStock = ProductsAttribute::where(['product_id' => $data['product_id'], 'size' => $data['size']])->first();
        if($getProductStock->stock < $data['quantity']) {
            $msg = 'Required quantity is not available for this size.';
            Session::flash('errorMessage', $msg);
            return redirect()->back();
        }

        // Generate session id if not exists
        $sessionId = Session::get('session_id');
        if(empty($sessionId)) {
            $sessionId = Session::getId();
            Session::put('session_id', $sessionId);
        }

        if(Auth::check()) {
            // User logged in
            $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'user_id' => Auth::user()->id])->count();
        } else {
            // User not logged in
            $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'session_id' => Session::get('session_id')])->count();
        }
        // If product already exists in cart
        if($countProducts > 0) {
            $msg = 'Product already exists in Cart !';
            Session::flash('errorMessage', $msg);
            return redirect()->back();
        }

        $cart = new Cart;
        $cart->session_id = $sessionId;
        $cart->product_id = $data['product_id'];
        $cart->size = $data['size'];
        $cart->quantity = $data['quantity'];
        $cart->save();

        $msg = 'Product has been added to the Cart.';
        Session::flash('successMessage', $msg);
        return redirect('cart');
    }

    function cart() {
        $userCartItems = Cart::userCartItems();
//        echo '<pre>'; print_r($userCartItems); die;
        return view('front.products.cart')->with(compact('userCartItems'));
    }
}
