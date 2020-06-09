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
            $products = new Product;
        } else {
            $title = "Edit Product";
        }

        if($request->isMethod('post')) {
            $data = $request->all();
//            echo "<pre>"; print_r($data); die;

            //Add product validation
            $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|regex:/^[\w-]*$/',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_price' => 'required|numeric'
            ];
            $errorMessages = [
                'category_id.required' => 'Category id is required.',
                'product_name.required' => 'Product name is required.',
                'product_name.regex' => 'Valid product name is required.',
                'product_code.required' => 'Product code is required.',
                'product_code.regex' => 'Valid product code is required.',
                'product_color.required' => 'Product colour is required.',
                'product_color.regex' => 'Valid product colour is required.',
                'product_price.required' => 'Product price is required.',
                'product_price.numeric' => 'Valid product price is required.'
            ];

            $this->validate($request, $rules, $errorMessages);

            //is featured?
            if(empty($data['is_featured'])) {
                $is_featured = "No";
            } else {
                $is_featured = "Yes";
            }

            //if optional fields are empty
            if(empty($data['fabric'])) {
                $data['fabric'] = "";
            }
            if(empty($data['sleeve'])) {
                $data['sleeve'] = "";
            }
            if(empty($data['pattern'])) {
                $data['pattern'] = "";
            }
            if(empty($data['fit'])) {
                $data['fit'] = "";
            }
            if(empty($data['occasion'])) {
                $data['occasion'] = "";
            }
            if(empty($data['meta_title'])) {
                $data['meta_title'] = "";
            }
            if(empty($data['meta_keywords'])) {
                $data['meta_keywords'] = "";
            }
            if(empty($data['meta_description'])) {
                $data['meta_description'] = "";
            }
            if(empty($data['product_video'])) {
                $data['product_video'] = "";
            }
            if(empty($data['product_image'])) {
                $data['product_image'] = "";
            }
            if(empty($data['product_weight'])) {
                $data['product_weight'] = "";
            }
            if(empty($data['product_description'])) {
                $data['product_description'] = "";
            }
            if(empty($data['wash_care'])) {
                $data['wash_care'] = "";
            }

            //save product details to product table
            $categoryDetails = Category::find($data['category_id']);
//            echo "<pre>"; print_r($categoryDetails); die;
            $products->section_id = $categoryDetails['section_id'];
            $products->category_id = $data['category_id'];
            $products->product_name = $data['product_name'];
            $products->product_code = $data['product_code'];
            $products->product_color = $data['product_color'];
            $products->product_price = $data['product_price'];
            $products->product_discount = $data['product_discount'];
            $products->product_weight = $data['product_weight'];
            $products->product_video = $data['product_video'];
            $products->product_image = $data['product_image'];
            $products->product_description = $data['product_description'];
            $products->wash_care = $data['wash_care'];
            $products->fabric = $data['fabric'];
            $products->pattern = $data['pattern'];
            $products->sleeve = $data['sleeve'];
            $products->fit = $data['fit'];
            $products->occasion = $data['occasion'];
            $products->meta_title = $data['meta_title'];
            $products->meta_description = $data['meta_description'];
            $products->meta_keywords = $data['meta_keywords'];
            $products->is_featured = $is_featured;
            $products->status = 1;
            $products->save();

            Session::flash('successMessage', 'Product Added Successfully.');
            return redirect('admin/products');
        }

        //filter arrays
        $fabricArray = array('Cotton', 'Polyester', 'Wool');
        $sleeveArray = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'SleeveLess');
        $patternArray = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
        $fitArray = array('Regular', 'Slim');
        $occasionArray = array('Formal', 'Casual');

        //Section with categories and sub categories
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories), true);
//        echo "<pre>"; print_r($categories); die();


        return view('admin.addEditProduct')->with(compact('title',  'fabricArray', 'sleeveArray','patternArray', 'fitArray', 'occasionArray', 'categories'));
    }
}
