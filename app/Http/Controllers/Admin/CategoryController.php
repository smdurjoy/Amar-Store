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
        $categories = Category::all();
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
            $title = "Add Category";
            //add category functionality
            $category = new Category;
        } else {
            $title = "Edit Category";
            //edit category functionality
        }

        //get all sections
        $getSections = Section::get();

        if($request->isMethod('post')) {
            $data = $request->all();

            //upload image
            if($request->hasFile('category_image')) {
                $imageTmp = $request->file('category_image');
                if($imageTmp->isValid()) {
                    //get image extension
                    $extension = $imageTmp->getClientOriginalExtension();
                    // generate new image name
                    $imageName = rand(111, 99999).'.'.$extension;
                    $imagePath = 'images/adminPhoto/'.$imageName;
                    //upload the image
                    Image::make($imageTmp)->save($imagePath);
                    //save image in db
                    $category->category_image = $imageName;
                }
            }

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
        }
        return view('admin.addEditCategory')->with(compact('title', 'getSections'));
    }
}
