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
            $shipping = ShippingCharge::find($id);
            $shipping->shipping_charge = $request->charge;
            $shipping->save();
            Session::flash('successMessage', $shipping->country." shipping charge has been updated successfully.");
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
