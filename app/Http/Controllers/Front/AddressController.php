<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Country;
use App\DeliveryAddress;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    function addEditDeliveryAddress($id=null, Request $request) {
        if($id == "") {
            // Add delivery address
            $title = "Add Delivery Address";
            $address = new DeliveryAddress;
            $addressData = array();
            $message = "Delivery address added successfully.";
        }else {
            // Edit delivery address
            $title = "Edit Delivery Address";
            $addressData = DeliveryAddress::find($id);
            $address = DeliveryAddress::find($id);
            $message = "Delivery address updated successfully.";
        }

        if($request->isMethod('post')) {

            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric',
                'address' => 'required',
                'city' => 'required',
            ];
            $errorMessages = [
                'name.required' => 'Name is required.',
                'name.alpha' => 'Please enter valid name.',
                'mobile.required' => 'Mobile Number is required.',
                'mobile.numeric' => 'Please enter valid mobile number.',
                'address.required' => 'Address is required.',
                'city.required' => 'City is required.',
            ];

            $this->validate($request, $rules, $errorMessages);

            $address->user_id = Auth::user()->id;
            $address->name = $request->name;
            $address->address = $request->address;
            $address->mobile = $request->mobile;
            $address->city = $request->city;
            $address->pincode = $request->pincode;
            $address->country = $request->country;
            $address->state = $request->state;
            $address->save();

            Session::flash('successMessage', $message);
            return redirect('/checkout');
        }

        $countries = Country::where('status', 1)->get()->toArray();
        return view('front.addresses.addEditDeliveryAddress')->with(compact('countries', 'title', 'addressData'));
    }

    function deleteAddress($id) {
        DeliveryAddress::find($id)->delete();
        Session::flash('successMessage', "Address Deleted Successfully.");
        return redirect()->back();
    }
}
