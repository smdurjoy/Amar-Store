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
use Illuminate\Support\Facades\View;
use App\Coupon;
use App\User;
use App\DeliveryAddress;

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

        // Add user id if user logged in
        if(Auth::check()) {
            $user_id = Auth::user()->id;
        }else {
            $user_id = 0;
        }

        $cart = new Cart;
        $cart->session_id = $sessionId;
        $cart->user_id = $user_id;
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

    function updateCartItemQty(Request $request) {
        if($request->ajax()) {
            $data = $request->all();

            // get cart details 
            $cartDetails = Cart::find($data['cartId']);

            // check available product stock
            $availableStock = ProductsAttribute::select('stock')->where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['size']])->first()->toArray();

            if($data['qty'] > $availableStock['stock']) {
                $userCartItems = Cart::userCartItems();
                return response()->json([
                    'status' => false,
                    'view' => (String)View('front.products.cartItems')->with(compact('userCartItems'))
                ]);
            }

            Cart::where('id', $data['cartId'])->update(['quantity' => $data['qty']]);
            $userCartItems = Cart::userCartItems();
            $totalCartItems = totalCartItems();
            return response()->json([
                'status' => true,
                'totalCartItems' => $totalCartItems,
                'view' => (String)View('front.products.cartItems')->with(compact('userCartItems'))
            ]);
        }
    }

    function deleteCartItem(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            Cart::where('id',$data['id'])->delete();
            $userCartItems = Cart::userCartItems();
            $totalCartItems = totalCartItems();
            return response()->json([
                'totalCartItems' => $totalCartItems,
                'view' => (String)View('front.products.cartItems')->with(compact('userCartItems'))
            ]);
        }
    }

    function applyCoupon(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            $countCoupon = Coupon::where('coupon_code', $data['code'])->count();
            if($countCoupon == 0) {
                // If coupon not exists
                $userCartItems = Cart::userCartItems();
                $totalCartItems = totalCartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid Coupon !',
                    'totalCartItems' => $totalCartItems,
                    'view' => (String)View('front.products.cartItems')->with(compact('userCartItems'))
                ]);
            }else {
                $couponDetails = Coupon::where('coupon_code', $data['code'])->first();

                // Check if coupon is inactive
                if($couponDetails->status == 0) {
                    $message = "This coupon is not active !";
                }

                // Check if coupon is expired
                $currentDate = date('Y-m-d');
                if($couponDetails->expiry_date < $currentDate) {
                    $message = "This coupon is expired !";
                }

                $userCartItems = Cart::userCartItems();
                $categoryArray = explode(',', $couponDetails['categories']);

                // Check if coupon belongs to logged in user
                if(!empty($couponDetails->user)) {
                    $usersArray = explode(',', $couponDetails->users);
                    // get user id of all selected users
                    foreach ($usersArray as $key => $user) {
                        $getUserId = User::select('id')->where('email', $user)->first()->toArray();
                        $userId[] = $getUserId['id'];
                    } 
                }

                $totalAmount = 0;
                foreach ($userCartItems as $key => $item) {
                    // Check if any item belong to coupon category
                    if(!in_array($item['product']['category_id'], $categoryArray)) {
                        $message = "This coupon is not for one of the selected products.";
                    }

                    if(!empty($couponDetails->user)) {
                        // Check if coupon belongs to logged in user
                        if(!in_array($item['user_id'], $userId)) {
                            $message = "This coupon is not for you !";  
                        }
                    }

                    // Get cart total amount
                    $attrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']);
                    $totalAmount = $totalAmount + ($attrPrice['final_price'] * $item['quantity']);
                }

                if(isset($message)) {
                    $userCartItems = Cart::userCartItems();
                    $totalCartItems = totalCartItems();
                    return response()->json([
                        'status' => false,
                        'message' => $message,
                        'totalCartItems' => $totalCartItems,
                        'view' => (String)View('front.products.cartItems')->with(compact('userCartItems'))
                    ]);
                }else {
                    if($couponDetails->amount_type == "Fixed") {
                        $couponAmount = $couponDetails->amount;
                    }else {
                        $couponAmount = $totalAmount * ($couponDetails->amount/100);
                    }
                    $grandTotal = $totalAmount - $couponAmount;
                    
                    // Add coupon code and amount in session variables
                    Session::put('couponCode', $data['code']);
                    Session::put('couponAmount', $couponAmount);

                    $message = "Coupon code successfully applied .";
                    $userCartItems = Cart::userCartItems();
                    $totalCartItems = totalCartItems();
                    return response()->json([
                        'status' => true,
                        'message' => $message,
                        'couponAmount' => $couponAmount,
                        'grandTotal' => $grandTotal,
                        'totalCartItems' => $totalCartItems,
                        'view' => (String)View('front.products.cartItems')->with(compact('userCartItems'))
                    ]);
                }
            }
        }
    }

    function checkout() {
        $userCartItems = Cart::userCartItems();
        $deliveryAddresses = DeliveryAddress::deliveryAddresses();
        return view('front.products.checkout')->with(compact('userCartItems', 'deliveryAddresses'));
    }
}
