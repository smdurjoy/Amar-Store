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
        Route::get('dashboard', 'AdminController@index');
        Route::get('settings', 'AdminController@settings');
        Route::get('logout', 'AdminController@logout');
        Route::post('checkCurrentPass', 'AdminController@checkCurrentPass');
        Route::post('updateCurrentPass', 'AdminController@updateCurrentPass');
        Route::match(['get', 'post'],'updateAdminDetails', 'AdminController@updateAdminDetails');

        //section
        Route::get('sections', 'SectionController@index');
    });
});
