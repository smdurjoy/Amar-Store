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
        Route::post('updateSectionStatus', 'SectionController@updateSectionStatus');

        // Category routes
        Route::get('categories', 'CategoryController@index');
        Route::post('catStatus', 'CategoryController@updateCategoryStatus');
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory');
        Route::post('categoriesLevel', 'CategoryController@categoriesLevel');
        Route::get('delete-category-image/{id}', 'CategoryController@deleteCategoryImage');
        Route::get('delete-category/{id}', 'CategoryController@deleteCategory');

        // Product routes
        Route::get('products', 'ProductController@index');
        Route::post('proStatus', 'ProductController@updateProductStatus');
        Route::match(['get', 'post'], 'add-edit-product/{id?}', 'ProductController@addEditProduct');
        Route::get('delete-product/{id}', 'ProductController@deleteProduct');
        Route::match(['get', 'post'], '/add-edit-product/{id?}', 'ProductController@addEditProduct');
        Route::get('delete-product-image/{id}', 'ProductController@deleteProductImage');
        Route::get('delete-product-video/{id}', 'ProductController@deleteProductVideo');
    });
});
