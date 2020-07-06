<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Section;
use App\ProductsAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

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
            $productData = array();
            $message = "Product Added Successfully";
        } else {
            //product edit functionality if id is coming
            $title = "Edit Product";
            $productData = Product::find($id);
            $productData = json_decode(json_encode($productData), true);
//            echo "<pre>"; print_r($productData); die();
            $products = Product::find($id);
            $message = "Product Updated Successfully";
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
            if(empty($data['product_discount'])) {
                $data['product_discount'] = "";
            }
            if(empty($data['wash_care'])) {
                $data['wash_care'] = "";
            }

            //upload image
            if($request->hasFile('product_image')) {
                // take the image
                $imageTmp = $request->file('product_image');
                // if image is valid
                if($imageTmp->isValid()) {
                    // get image original name
                    $image_name = $imageTmp->getClientOriginalName();
                    // get image extension
                    $imageExtension = $imageTmp->getClientOriginalExtension();
                    // generate new image name
                    $imageName = $image_name.'-'.rand(111, 99999).'.'.$imageExtension;
//                    echo "<pre>"; print_r($imageName); die;
                    // set image path for both large, medium and small image
                    $largeImagePath = 'images/productImages/large/'.$imageName;
                    $mediumImagePath = 'images/productImages/medium/'.$imageName;
                    $smallImagePath = 'images/productImages/small/'.$imageName;
                    // resize and save the image into that paths
                    Image::make($imageTmp)->save($largeImagePath);
                    Image::make($imageTmp)->resize(520, 600)->save($mediumImagePath);
                    Image::make($imageTmp)->resize(260, 300)->save($smallImagePath);
                    //save image in database
                    $products->product_image = $imageName;
                }
            }

            //upload video
            if($request->hasFile('product_video')) {
                $videoTmp = $request->file('product_video');
                if($videoTmp->isValid()) {
                    $video_name = $videoTmp->getClientOriginalName();
                    $videoExtension = $videoTmp->getClientOriginalExtension();
                    $videoName = $video_name.'-'.rand(111, 99999).'.'.$videoExtension;
                    $videoPath = 'videos/productVideos/';
                    $videoTmp->move($videoPath, $videoName);
                    // save video in db
                    $products->product_video = $videoName;
                }
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

            Session::flash('successMessage', $message);
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


        return view('admin.addEditProduct')->with(compact('title',  'fabricArray', 'sleeveArray','patternArray', 'fitArray', 'occasionArray', 'categories', 'productData'));
    }

    function deleteProductImage($id) {
        // Get product image
        $productImage = Product::select('product_image')->where('id', $id)->first();

        // Get product image path
        $smallImagePath = "images/productImages/small/";
        $mediumImagePath = "images/productImages/medium/";
        $largeImagePath = "images/productImages/large/";

        // if the images exists then delete from folder
        if(file_exists($smallImagePath.$productImage->product_image)) {
            unlink($smallImagePath.$productImage->product_image);
        }
        if(file_exists($mediumImagePath.$productImage->product_image)) {
            unlink($mediumImagePath.$productImage->product_image);
        }
        if(file_exists($largeImagePath.$productImage->product_image)) {
            unlink($largeImagePath.$productImage->product_image);
        }

        // Delete image from products table
        Product::where('id', $id)->update(['product_image' => '']);
        $message = "Photo Deleted Successfully!";
        Session::flash('successMessage', $message);
        return redirect()->back();
    }

    function deleteProductVideo($id) {
        // Get product video
        $productVideo = Product::select('product_video')->where('id', $id)->first();

        // Get product video path
        $videoPath = "videos/productVideos/";

        // if the videos exists then delete from folder
        if(file_exists($videoPath.$productVideo->product_video)) {
            unlink($videoPath.$productVideo->product_video);
        }

        // Delete video from products table
        Product::where('id', $id)->update(['product_video' => '']);
        $message = "Video Deleted Successfully!";
        Session::flash('successMessage', $message);
        return redirect()->back();
    }

    function addAttributes(Request $request, $id) {
        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            foreach ($data['sku'] as $key => $value) {
                if(!empty($value)) {

                    // If sku already exist
                    $attrCountSku = ProductsAttribute::where('sku', $value)->count();
                    if($attrCountSku > 0) {
                        $msg = 'SKU already exists ! Please try another one.';
                        Session::flash('errorMessage', $msg);
                        return redirect()->back();
                    }
                    
                    // If size already exist of the same product id
                    $attrCountSize = ProductsAttribute::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();
                    if($attrCountSize > 0) {
                        $msg = 'Size already exists of this product ! Please try another one.';
                        Session::flash('errorMessage', $msg);
                        return redirect()->back();
                    }

                    $attributes =  new ProductsAttribute;
                    $attributes->product_id = $id;
                    $attributes->sku = $value;
                    $attributes->size = $data['size'][$key];
                    $attributes->price = $data['price'][$key];
                    $attributes->stock = $data['stock'][$key];
                    $attributes->save();

                    $msg = 'Attributes Added Successfully !';
                    Session::flash('successMessage', $msg);
                    return redirect()->back();
                }  
            }
        }
        $productData = Product::find($id);
        // $productData = json_decode(json_encode($productData));
//        echo "<pre>"; print_r($productData); die;
        $title = "Product Attributes";
        return view('admin.addAttributes')->with(compact('productData', 'title'));
    }
}
