<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Banner;
use Intervention\Image\Facades\Image;

class BannersController extends Controller
{
    function index() {
        Session::put('page', 'banners');
        $banners = Banner::get()->toArray();
        // dd($banners);
        return view('admin.banners')->with(compact('banners'));
    }

    function updateBannerStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Banner::where('id', $data['record_id'])->update(['status' => $status]);
            return response()->json(['status' => $status]);
        }
    }

    function deleteBanner($id) {
        Banner::where('id', $id)->delete();

        $message = "Banner Deleted Successfully!";
        Session::flash('successMessage', $message);
        return redirect()->back();
    }

    function addEditBanner(Request $request, $id=null) {
        if($id == "") {
            $title = "Add Banner";
            $message = "Banner Added Successfully !";
            $banner = new Banner;
        } else {
            $title = "Edit Banner";
            $message = "Banner Updated Successfully !";
            $banner = Banner::find($id);
        }

        if($request->isMethod('post')) {
            $data = $request->all();
            // echo '<pre>'; print_r($data); die;
            $banner->title = $data['banner_title'];
            $banner->link = $data['banner_link'];
            $banner->alt = $data['alt'];
            $banner->status = 1;

            if($request->hasFile('banner_image')) {
                $imageTmp = $request->file('banner_image');
                if($imageTmp->isValid()) {
                    $imageOriginalName = $imageTmp->getClientOriginalName();
                    $extension = $imageTmp->getClientOriginalExtension();
    
                    $imageName = $imageOriginalName.'-'.rand(111, 99999).'.'.$extension;
                    $bannerImagePath = 'images/bannerImages/'.$imageName;
    
                    // resize image
                    Image::make($imageTmp)->resize(1170, 400)->save($bannerImagePath);
                    $banner->image = $imageName;
                }   
            }

            $banner->save();
            Session::flash('successMessage', $message);
            return redirect('admin/banners');
        }

        return view('admin/addEditBanners')->with(compact('banner', 'title'));
    }

    function deleteImage($id) {
        // Get product image
        $bannerImage = Banner::select('image')->where('id', $id)->first();

        // Get Banner image path
        $bannerImagePath = "images/bannerImages/";

        // if the image exists then delete from folder
        if(file_exists($bannerImagePath.$bannerImage->image)) {
            unlink($bannerImagePath.$bannerImage->image);
        }

        // Delete image from Banners table
        Banner::where('id', $id)->update(['image' => '']);
        $message = "Banner image has been deleted successfully !";
        Session::flash('successMessage', $message);
        return redirect()->back();
    }
}
