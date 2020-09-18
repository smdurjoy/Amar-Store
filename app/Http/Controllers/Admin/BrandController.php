<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    function index() {
        $brands = Brand::all();
        return view('admin.brands')->with(compact('brands'));
    }
}
