<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    function index() {
        return view('admin.dashboard');
    }

    function login(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();
//            echo "<pre>"; print_r($data); die;

            $rules = [
                'email' => 'required',
                'password' => 'required',
            ];

            $errorMessage = [
                'email.required' => 'Please enter your email address',
                'email.email' => 'Please enter valid email',
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
}
