<?php

use App\Http\Controllers\CommonAPIController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/404_not_found', function () {
    return view('404');
});

// Admin routes
Route::prefix('/admin')->namespace('Admin')->group(function () {
    Route::match(['get', 'post'], '/', 'AdminController@login');

    Route::group(['middleware' => ['admin']], function () {
        // Admin routes
        Route::get('dashboard', 'AdminController@index');
        Route::get('settings', 'AdminController@settings');
        Route::get('logout', 'AdminController@logout');
        Route::post('checkCurrentPass', 'AdminController@checkCurrentPass');
        Route::post('updateCurrentPass', 'AdminController@updateCurrentPass');
        Route::match(['get', 'post'], 'updateAdminDetails', 'AdminController@updateAdminDetails');

        // Section routes
        Route::get('sections', 'SectionController@index');
        Route::post('update-section-status', 'SectionController@updateSectionStatus');

        // Brands routes
        Route::get('brands', 'BrandController@index');
        Route::post('update-brand-status', 'BrandController@updateBrandStatus');
        Route::match(['get', 'post'], 'add-edit-brand/{id?}', 'BrandController@addEditBrand');
        Route::get('delete-brand/{id}', 'BrandController@deleteBrand');

        // Category routes
        Route::get('categories', 'CategoryController@index');
        Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory');
        Route::post('categoriesLevel', 'CategoryController@categoriesLevel');
        Route::get('delete-category-image/{id}', 'CategoryController@deleteCategoryImage');
        Route::get('delete-category/{id}', 'CategoryController@deleteCategory');

        // Product routes
        Route::get('products', 'ProductController@index');
        Route::post('update-product-status', 'ProductController@updateProductStatus');
        Route::match(['get', 'post'], 'add-edit-product/{id?}', 'ProductController@addEditProduct');
        Route::get('delete-product/{id}', 'ProductController@deleteProduct');
        Route::get('delete-product-image/{id}', 'ProductController@deleteProductImage');
        Route::get('delete-product-video/{id}', 'ProductController@deleteProductVideo');

        // Attributes
        Route::match(['get', 'post'], 'add-attributes/{id?}', 'ProductController@addAttributes');
        Route::post('update-attribute-status', 'ProductController@updateAttributeStatus');
        Route::post('edit-attributes/{id?}', 'ProductController@editAttributes');
        Route::get('delete-attribute/{id}', 'ProductController@deleteAttribute');

        // Images
        Route::match(['get', 'post'], 'add-images/{id}', 'ProductController@addImages');
        Route::post('update-productImage-status', 'ProductController@updateProductImageStatus');
        Route::get('delete-productImage/{id}', 'ProductController@deleteImage');

        // Banners
        Route::get('banners', 'BannersController@index');
        Route::match(['get', 'post'], 'add-edit-banner/{id?}', 'BannersController@addEditBanner');
        Route::post('update-banner-status', 'BannersController@updateBannerStatus');
        Route::get('delete-banner/{id}', 'BannersController@deleteBanner');
        Route::get('delete-banner-image/{id}', 'BannersController@deleteImage');

        // Coupons
        Route::get('coupons', 'CouponsController@index');
        Route::post('update-coupon-status', 'CouponsController@updateCouponStatus');
        Route::match(['get', 'post'], 'add-edit-coupon/{id?}', 'CouponsController@addEditCoupon');
        Route::get('delete-coupon/{id}', 'CouponsController@deleteCoupon');

        // Orders
        Route::get('orders', 'OrdersController@index');
        Route::get('orders/{id}', 'OrdersController@orderDetails');
        Route::post('update-order-status', 'OrdersController@updateOrderStatus');
        Route::get('view-order-invoice/{id}', 'OrdersController@viewOrderInvoice');

        // Shipping Charges
        Route::get('view-shipping-charges', 'ShippingController@viewShippingCharges');
        Route::match(['get', 'post'], 'edit-shipping-charge/{id}', 'ShippingController@editShippingCharge');
        Route::post('update-shipping-status', 'ShippingController@updateShippingStatus');

        // Reviews
        Route::get('reviews', [ReviewController::class, 'index']);
        Route::post('update-review-status', [ReviewController::class, 'updateStatus']);
        Route::get('delete-review/{review}', [ReviewController::class, 'delete']);
    });
});


// Frontend Routes
Route::namespace('Front')->group(function () {
    // Homepage routes
    Route::get('/', 'HomeController@index');

    // Listing page route
    $categoryUrls = Category::where('status', 1)->select('url')->get()->pluck('url')->toArray();
    foreach ($categoryUrls as $url) {
        Route::get('/' . $url, 'ProductsController@listing');
    }

    // Product Detail Routes
    Route::get('/product/{id}/{name}', 'ProductsController@productDetail');
    Route::post('/getProductPrice', 'ProductsController@getProductPrice');

    // Add to cart routes
    Route::post('add-to-cart', 'ProductsController@addToCart');
    // Shopping cart route
    Route::get('/cart', 'ProductsController@cart');
    // Update cart quantity
    Route::post('update-cart-qty', 'ProductsController@updateCartItemQty');
    // Delete cart item
    Route::post('delete-cart-item', 'ProductsController@deleteCartItem');
    // Login/Register Page
    Route::get('/login-register', 'UserController@loginRegister')->name('login');
    // User login
    Route::post('/login', 'UserController@userLogin');
    // User Register
    Route::post('/register', 'UserController@userRegister');
    Route::match(['get', 'post'], '/check-email', 'UserController@checkEmail');
    // User Logout
    Route::get('/logout', 'UserController@userLogout');
    // Email confirmation
    Route::match(['get', 'post'], '/confirm/{code}', 'UserController@confirmAccount');
    // Forgot pass
    Route::match(['get', 'post'], '/forgot-password', 'UserController@forgotPass');
    // product api
    Route::get('get-product', [CommonAPIController::class, 'getProduct']);

    Route::group(['middleware' => 'auth'], function () {
        // User account
        Route::match(['get', 'post'], '/account', 'UserController@account');
        // Check current password
        Route::post('/check-current-pass', 'UserController@checkCurrentPass');
        // Update password
        Route::post('/update-password', 'UserController@updatePassword');
        // Apply coupon
        Route::post('/apply-coupon', 'ProductsController@applyCoupon');
        // Checkout
        Route::match(['GET', 'POST'], '/checkout', 'ProductsController@checkout');
        // Add edit delivery address
        Route::match(['GET', 'POST'], '/add-edit-delivery-address/{id?}', 'AddressController@addEditDeliveryAddress');
        // Delete delivery address
        Route::get('/delete-address/{id}', 'AddressController@deleteAddress');
        // Thanks for order page
        Route::get('/thanks', 'ProductsController@thanks');
        // User orders
        Route::get('/orders', 'OrdersController@index');
        Route::get('orders/unconfirmed', 'OrdersController@unconfirmedOrders');
        // User orders details
        Route::get('/orders/{id}', 'OrdersController@orderDetails');
        // ssl prepaid
        Route::post('pay-prepaid', 'PrepaidController@ssl');
        Route::post('prepaid/success', 'PrepaidController@success');
        Route::post('prepaid/fail', 'PrepaidController@fail');
        Route::post('prepaid/cancel', 'PrepaidController@cancel');
        Route::post('prepaid/ipn', 'PrepaidController@ipn');
        // paypal
        Route::get('/paypal', 'PaypalController@index');
        Route::get('/paypal/success', 'PaypalController@success');
        Route::get('/paypal/fail', 'PaypalController@fail');
        Route::post('/paypal/ipn', 'PaypalController@ipn');

        // product review
        Route::post('review', [ReviewController::class, 'store']);
    });
});

Route::any('{catchall}', [
    function () {
        return abort(404);
    }
])->where('catchall', '.*');

