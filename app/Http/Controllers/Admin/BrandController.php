<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    function index() {
        Session::put('page', 'brands');
        $brands = Brand::all();
        return view('admin.brands')->with(compact('brands'));
    }

    function updateBrandStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Brand::where('id', $data['record_id'])->update(['status' => $status]);
            return response()->json(['status' => $status]);
        }
    }

    function addEditBrand(Request $request, $id=null) {
        if($id == '') {
            $title = 'Add Brand';
            $brand = new Brand;
            $message = 'Brand Added Successfully !';
        } else {
            $title = 'Edit Brand';
            $brand = Brand::find($id);
            $message = 'Brand Updated Successfully !';
        }

        if($request->isMethod('post')) {
            $data = $request->all();
            // echo '<pre>'; print_r($data); die;

            //Add brand validation
            $rules = [
                'brand_name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $errorMessages = [
                'brand_name.required' => 'Please enter brand name !',
                'brand_name.regex' => 'Please enter a valid brand name !',
            ];

            $this->validate($request, $rules, $errorMessages);

            $brand->name = $data['brand_name'];
            $brand->status = 1;
            $brand->save();

            Session::flash('successMessage', $message);
            return redirect('admin/brands');
        }

        return view('admin.addEditBrands')->with(compact('title', 'brand', 'message'));
    }

    
    function deleteBrand($id) {
        Brand::where('id', $id)->delete();

        $message = "Brand Deleted Successfully!";
        Session::flash('successMessage', $message);
        return redirect()->back();
    }
}
