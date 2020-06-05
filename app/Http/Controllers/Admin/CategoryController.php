<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Section;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    function index() {
        Session::put('page', 'categories');
        $categories = Category::with(['section', 'parentCategory'])->get();
//        $categories = json_decode(json_encode($categories));
//        echo "<pre>"; print_r($categories); die();
        return view('admin.categories')->with(compact('categories'));
    }

    function updateCategoryStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }

    function addEditCategory(Request $request, $id= null) {
        if($id == "") {
            //add category functionality
            $title = "Add Category";
            $category = new Category;
            $categoryData = array();
            $getCategories = array();
            $successMessage = "Category Added Successfully!";
        } else {
            //edit category functionality
            $title = "Edit Category";
            $categoryData = Category::where('id', $id)->first();
            $getCategories = Category::with('subCategories')->where(['parent_id' =>0, 'section_id' => $categoryData['section_id']])->get();
            $category = Category::find($id);
            $successMessage = "Category Updated Successfully!";
//            $getCategories = json_decode(json_encode($getCategories), true);
//            echo "<pre>"; print_r($getCategories); die();
        }

        //Add category validation
        if($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required',
                'url' => 'required',
                'category_image' => 'image'
            ];
            $errorMessages = [
                'category_name.required' => 'Please add category name.',
                'adminName.regex' => 'Please enter valid category name.',
                'section_id.required' => 'Section is required.',
                'url' => 'Category url is required.',
                'category_image.image' => 'Valid image is required!'
            ];

            $this->validate($request, $rules, $errorMessages);

            //upload image
            if($request->hasFile('category_image')) {
                $imageTmp = $request->file('category_image');
                if($imageTmp->isValid()) {
                    //get image extension
                    $extension = $imageTmp->getClientOriginalExtension();
                    // generate new image name
                    $imageName = rand(111, 99999).'.'.$extension;
                    $imagePath = 'images/categoryImages/'.$imageName;
                    //upload the image
                    Image::make($imageTmp)->save($imagePath);
                    //save image in db
                    $category->category_image = $imageName;
                }
            }

            // if fields are empty
            if(empty($data['category_discount'])) {
                $data['category_discount'] = "";
            }
            if(empty($data['description'])) {
                $data['description'] = "";
            }
            if(empty($data['meta_title'])) {
                $data['meta_title'] = "";
            }
            if(empty($data['meta_description'])) {
                $data['meta_description'] = "";
            }
            if(empty($data['meta_keywords'])) {
                $data['meta_keywords'] = "";
            }

            // get data and save into database
            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;

            $category->save();

            // flash message
            Session::flash('successMessage', $successMessage);
            return redirect('admin/categories');
        }
        //get all sections
        $getSections = Section::get();

        return view('admin.addEditCategory')->with(compact('title', 'getSections', 'categoryData', 'getCategories'));
    }

    function categoriesLevel(Request $request) {
        if($request->ajax()) {
            $data = $request->all();

            $getCategories = Category::with('subCategories')->where(['section_id' => $data['section_id'], 'parent_id' => 0, 'status' => 1 ])->get();
            $getCategories = json_decode(json_encode($getCategories), true);
            return view('admin.categoriesLevel')->with(compact('getCategories'));
        }
    }

    function deleteCategoryImage($id) {
        $categoryImage = Category::select('category_image')->where('id', $id)->first();

        $categoryImagePath = "images/categoryImages/";

        if(file_exists($categoryImagePath.$categoryImage->category_image)) {
            unlink($categoryImagePath.$categoryImage->category_image);
        }

        Category::where('id', $id)->update(['category_image' => '']);

        return redirect()->back();
    }
}
