<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Session;
use Auth;
use App\Cart;
use App\Sms;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    function loginRegister() {
        return view('front.users.loginRegister');
    }

    function userLogin(Request $request) {
        $data = $request->all();
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {

            // Update user cart with user id
            if(!empty(Session::get('session_id'))) {
                $user_id = Auth::user()->id;
                $session_id = Session::get('session_id');
                Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
            }
            return redirect('/');
        }else {
            $message = "Invalid Email or Password";
            Session::flash('errorMessage', $message);
            return redirect()->back();
        }
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
                // Update user cart with user id
                if(!empty(Session::get('session_id'))) {
                    $user_id = Auth::user()->id;
                    $session_id = Session::get('session_id');
                    Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                }

                // Send Register SMS
                // $msg = "Dear Customer, you have been successfully register to Amar Store. Login to your account to access orders and available offers";
                // $number = $data['mobile'];
                // Sms::sendSms($msg, $number);

                // Send Register Email Offline
                $email = $data['email'];
                $messageBody = ['name' => $data['name'], 'mobile' => $data['mobile'], 'email' => $data['email']];
                Mail::send('emails.register', $messageBody, function($message) use($email) {
                    $message->to($email)->subject('Welcome to Amar Store');
                });

                return redirect('/');
            }
        }
    }

    function checkEmail(Request $request) {
        $data = $request->all();
        $emailCount = User::where('email', $data['email'])->count();
        if($emailCount > 0) {
            return 'false';
        }else {
            return 'true';
        }
    }

    function userLogout() {
        Auth::logout();
        return redirect('/');
    }
}
