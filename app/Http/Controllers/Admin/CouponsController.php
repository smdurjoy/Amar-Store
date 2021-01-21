<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Coupon;
use App\Section;
use App\User;
use Intervention\Image\Facades\Image;

class CouponsController extends Controller
{
    function index() {
        Session::put('page', 'coupons');
        $coupons = Coupon::get()->toArray();
        return view('admin.coupons')->with(compact('coupons'));
    }

    function updateCouponStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Coupon::where('id', $data['record_id'])->update(['status' => $status]);
            return response()->json(['status' => $status]);
        }
    }

    function addEditCoupon(Request $request, $id=null) {
        if($id == "") {
            // Add Coupon
            $coupon = new Coupon;
            $selectCats = array();
            $selectUsers = array();
            $title = "Add Coupon";
            $message = "Coupon added successfully.";
        }else { 
            // Edit Coupon
            $coupon = Coupon::find($id);
            $selectCats = explode(',', $coupon['categories']);
            $selectUsers = explode(',', $coupon['users']);
            $title = "Edit Coupon";
            $message = "Coupon updated successfully.";
        }   

        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Coupon add validation
            $rules = [
                'categories' => 'required',
                'coupon_option' => 'required',
                'coupon_type' => 'required',
                'amount_type' => 'required',
                'amount' => 'required|numeric',
                'expiry_date' => 'required'
            ];
            $errorMessages = [
                'categories.required' => 'Please select categories.',
                'coupon_option.required' => 'Please select coupon option.',
                'coupon_type.required' => 'Please select coupon type.',
                'amount_type.required' => 'Please select amount type.',
                'amount.required' => 'Please enter amount.',
                'amount.numeric' => 'Valid amount is required.',
                'expiry_date.required' => 'Please add expiry date.'
            ];

            $this->validate($request, $rules, $errorMessages);

            if(isset($data['users'])) {
                $users = implode(',', $data['users']);
            }else {
                $users = "";
            }

            if(isset($data['categories'])) {
                $categories = implode(',', $data['categories']);
            }
            
            if($data['coupon_option'] == "Automatic") {
                $coupon_code = str_random(6);
            }else {
                $coupon_code = $data['coupon_code'];
            }

            $coupon->coupon_option = $data['coupon_option'];
            $coupon->coupon_code = $coupon_code;
            $coupon->categories = $categories;
            $coupon->users = $users;
            $coupon->coupon_type = $data['coupon_type'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->amount = $data['amount'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->status = 1;
            $coupon->save();

            Session::flash('successMessage', $message);
            return redirect('admin/coupons');
         }

        $categories = Section::with('categories')->get()->toArray();
        $users = User::where('status', 1)->get()->toArray();

        return view('admin.addEditCoupons')->with(compact('title', 'coupon', 'categories', 'users', 'selectCats', 'selectUsers'));
    }

    function deleteCoupon($id) {
        Coupon::where('id', $id)->delete();

        $message = "Coupon Deleted Successfully!";
        Session::flash('successMessage', $message);
        return redirect()->back();
    }
}
