<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin routes
Route::prefix('/admin')->namespace('Admin')->group(function() {
    Route::match(['get', 'post'],'/', 'AdminController@login');

    Route::group(['middleware' => ['admin']], function() {
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
        Route::match(['get', 'post'], '/add-edit-product/{id?}', 'ProductController@addEditProduct');
        Route::get('delete-product-image/{id}', 'ProductController@deleteProductImage');
        Route::get('delete-product-video/{id}', 'ProductController@deleteProductVideo');

        // Attributes
        Route::match(['get', 'post'], 'add-attributes/{id?}', 'ProductController@addAttributes');
        Route::post('update-attribute-status', 'ProductController@updateAttributeStatus');
        Route::post('edit-attributes/{id?}', 'ProductController@editAttributes');

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
    });
});

// Frontend Routes
Route::namespace('Front')->group(function() {
    // Homepage routes
    Route::get('/', 'HomeController@index');

    // Listing category route
    Route::get('/{url}', 'ProductsController@listing');
});
