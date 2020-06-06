<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    function index() {
        Session::put('page', 'products');
        $products = Product::with(['category', 'section'])->get();
//        $products = json_decode(json_encode($products), true);
//        echo "<pre>"; print_r($products); die();
        return view('admin.products')->with(compact('products'));
    }

    function updateProductStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }

    function deleteProduct($id) {
        Product::where('id', $id)->delete();

        $message = "Product Deleted Successfully!";
        Session::flash('successMessage', $message);
        return redirect()->back();
    }

    function addEditProduct(Request $request, $id=null) {
        if($id == "") {
            $title = "Add Product";
        } else {
            $title = "Edit Product";
        }

        //filter arrays
        $fabricArray = array('Cotton', 'Polyester', 'Wool');
        $sleeveArray = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'SleeveLess');
        $patternArray = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
        $fitArray = array('Regular', 'Slim');
        $occasionArray = array('Formal', 'Casual');

        //Section with categories and sub categories
        $categories = Section::with('categories')->get();
//        $categories = json_decode(json_encode($categories), true);
//        echo "<pre>"; print_r($categories); die();

        return view('admin.addEditProduct')->with(compact('title',  'fabricArray', 'sleeveArray','patternArray', 'fitArray', 'occasionArray', 'categories'));
    }
}
