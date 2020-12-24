<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Admin;
use App\Section;
use App\Category;
use App\Brand;
use App\Product;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    function index() {
        Session::put('page', 'dashboard');
        $sections = Section::count();
        $categories = Category::count();
        $brands = Brand::count();
        $products = Product::count();
        return view('admin.dashboard')->with(compact('sections', 'categories', 'brands', 'products'));
    }

    function login(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|email',
                'password' => 'required',
            ];

            $errorMessage = [
                'email.required' => 'Please enter your email address',
                'email.email' => 'Please enter a valid email address',
                'password.required' => 'Please enter your password',
            ];

            $this->validate($request, $rules, $errorMessage);

            if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('admin/dashboard');
            } else {
                Session::flash('errorMessage', 'Invalid Email or Password!');
                return redirect()->back();
            }
        }
        return view('admin.login');
    }

    function logout() {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    function settings() {
        Session::put('page', 'settings');
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('admin.settings')->with(compact('adminDetails'));
    }

    function checkCurrentPass(Request $request) {
        $data = $request->all();
//        echo "<pre>"; print_r($data); die;
//        echo "<pre>"; print_r(Auth::guard('admin')->user()->password); die;
        if(Hash::check($data['currentPass'], Auth::guard('admin')->user()->password)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    function updateCurrentPass(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();
            // check if current pass in correct
            if(Hash::check($data['currentPass'], Auth::guard('admin')->user()->password)) {
            // check if new pass and confirm pass is matching
                if($data['newPass'] == $data['confirmPass']) {
                    Admin::where( 'id', Auth::guard('admin')->user()->id )->update(['password' => bcrypt($data['newPass'])]);
                    Session::flash('successMessage', 'Password has been updated.');
                } else {
                    Session::flash('errorMessage', 'Password did not matched!');
                }
            } else {
                Session::flash('errorMessage', 'Your current password is incorrect!');
            }
            return redirect()->back();
        }
    }

    function updateAdminDetails(Request $request) {
        Session::put('page', 'updateAdminDetails');
        if($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'adminName' => 'required|regex:/^[\pL\s\-]+$/u',
                'adminMobile' => 'required|numeric',
                'adminImage' => 'image'
            ];
            $errorMessages = [
                'adminName.required' => 'Name is required.',
                'adminName.alpha' => 'Please enter valid name.',
                'adminMobile.required' => 'Mobile Number is required.',
                'adminMobile.numeric' => 'Please enter valid mobile number.',
                'adminImage.image' => 'Please choose an image!'
            ];

            $this->validate($request, $rules, $errorMessages);

            //upload image
            if($request->hasFile('adminImage')) {
                $imageTmp = $request->file('adminImage');
                if($imageTmp->isValid()) {
                    //get image extension
                    $extension = $imageTmp->getClientOriginalExtension();
                    // generate new image name
                    $imageName = rand(111, 99999).'.'.$extension;
                    $imagePath = 'images/adminPhoto/'.$imageName;
                    //upload the image
                    Image::make($imageTmp)->save($imagePath);
                } else if(!empty($data['adminCurrentImage'])) {
                    $imageName = $data['adminCurrentImage'];
                } else {
                    $imageName = "";
                }
            }

            //update admin details
            Admin::where('email', Auth::guard('admin')->user()->email)->update(['name' => $data['adminName'], 'mobile' => $data['adminMobile'], 'image' => $imageName]);
            Session::flash('successMessage', 'Admin Details Updated Successfully.');
            return redirect()->back();
        }
        return view('admin.updateAdminDetails');
    }
}
