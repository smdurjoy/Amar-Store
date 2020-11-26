<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Session;
use Auth;

class UserController extends Controller
{
    function loginRegister() {
        return view('front.users.loginRegister');
    }

    function userRegister(Request $request) {
        $data = $request->all();
        // Check if user already exists
        $userCount = User::where('email', $data['email'])->count();
        if($userCount > 0) {
            $message = 'Email Already Exists !';
            session::flash('errorMessage', $message);
            return redirect()->back();
        } else {
            // Register user
            $user = new User();
            $user->name = $data['name'];
            $user->mobile = $data['mobile'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->status = 1;
            $user->save();

            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('/');
            }
        }
    }

    function userLogout() {
        Auth::logout();
        return redirect('/');
    }
}
