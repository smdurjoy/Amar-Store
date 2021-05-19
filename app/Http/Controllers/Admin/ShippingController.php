<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ShippingCharge;
use Illuminate\Support\Facades\Session;

class ShippingController extends Controller
{
    function viewShippingCharges() {
        Session::put('page', 'shipping');
        $shipping_charges = ShippingCharge::get();
        return view('admin.view-shipping-charges', compact('shipping_charges'));
    }

    function editShippingCharge($id, Request $request) {
        if($request->isMethod('post')) {
            ShippingCharge::where('id', $id)->update([
                '0_500g' => $request->input('0_500g'), 
                '501_1000g' => $request->input('501_1000g'),
                '1001_2000g' => $request->input('1001_2000g'),
                '2001_5000g' => $request->input('2001_5000g'),
                'above_5000g' => $request->input('above_5000g'),
            ]);

            Session::flash('successMessage', "Shipping charge has been updated successfully.");
            return redirect('admin/view-shipping-charges');
        }
        Session::put('page', 'shipping');
        $shipping_charge = ShippingCharge::where('id', $id)->first();
        return view('admin.edit-shipping-charge', compact('shipping_charge'));
    }

    function updateShippingStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            ShippingCharge::where('id', $data['record_id'])->update(['status' => $status]);
            return response()->json(['status' => $status]);
        }
    }
}
