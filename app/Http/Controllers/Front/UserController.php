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
use App\Country;

class UserController extends Controller
{
    function loginRegister() {
        return view('front.users.loginRegister');
    }

    function userLogin(Request $request) {
        $data = $request->all();
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            // Check email is activate or not
            $userStatus = User::where('email', $data['email'])->first()->status;
            if($userStatus == 0) {
                Auth::logout();
                $message = "Your account is not activated yet ! Please confirm your email to activate your account .";
                Session::flash('errorMessage', $message);
                return redirect()->back();
            }
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
            Session::flash('errorMessage', $message);
            return redirect()->back();
        } else {
            // Register user
            $user = new User();
            $user->name = $data['name'];
            $user->mobile = $data['mobile'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->status = 0;
            $user->save();

            $email = $data['email'];
            $messageBody = ['name' => $data['name'], 'code' => base64_encode($email)];
            Mail::send('emails.confirmation', $messageBody, function($message) use($email) {
                $message->to($email)->subject('Confirm your Amar Store accouunt');
            });

            $message = 'Please click the activation link we just sent to your email';
            Session::flash('successMessage', $message);
            return redirect()->back();
        }
    }

    function confirmAccount($email) {
        // Decode email
        $email = base64_decode($email);
        $user = User::where('email', $email);
        // Check email exists or not
        $userCount = $user->count();
        if($userCount > 0) {
            $userDetails = $user->first();
            // If account already activated
            if($userDetails->status == 1) {
                $message = "Your account is already activated !";
                Session::flash('errorMessage', $message);
                return redirect('login-register');
            } else {
                $user->update(['status' => 1]);

                // Send Register SMS
                // $msg = "Dear Customer, you have been successfully register to Amar Store. Login to your account to access orders and available offers";
                // $number = $userDetails['mobile'];
                // Sms::sendSms($msg, $number);

                // Send Register Email
                $messageBody = ['name' => $userDetails['name'], 'mobile' => $userDetails['mobile'], 'email' => $userDetails['email']];
                Mail::send('emails.register', $messageBody, function($message) use($email) {
                    $message->to($email)->subject('Welcome to Amar Store');
                });

                $message = "Your account activated successfully. You can log in now.";
                Session::flash('successMessage', $message);
                return redirect('login-register');
            }
        } else {
            return view('404');
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

    function forgotPass(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();
            $email = $data['email'];

            $emailCount = User::where('email', $email)->count();
            if($emailCount == 0) {
                Session::flash('errorMessage', 'Email does not exists !');
                return redirect()->back();
            }

            // Generate new password
            $randomPass = rand(11111, 99999);
            $newPass = bcrypt($randomPass);
            $name = User::where('email', $email)->first()->name;

            // Update password
            User::where('email', $email)->update(['password' => $newPass]);

            // Send new pass in email
            $messageBody = ['name' => $name, 'email' => $email, 'password' => $randomPass];
            Mail::send('emails.forgotPass', $messageBody, function($message) use($email) {
                $message->to($email)->subject('New Password - Amar Store');
            });

            $message = "Please check your email address for new password.";
            Session::flash('successMessage', $message);
            return redirect('/login-register');
        }
        return view('front.users.forgotPass');
    }

    function account(Request $request) {
        $id = Auth::user()->id;
        $userDetails = User::find($id)->toArray();
        $countries = Country::where('status', 1)->get()->toArray();

        if($request->isMethod('post')) {
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric'
            ];
            $errorMessages = [
                'name.required' => 'Name is required.',
                'name.alpha' => 'Please enter valid name.',
                'mobile.required' => 'Mobile Number is required.',
                'mobile.numeric' => 'Please enter valid mobile number.'
            ];

            $this->validate($request, $rules, $errorMessages);

            $user = User::find($id);
            $user->name = $request->name;
            $user->address = $request->address;
            $user->mobile = $request->mobile;
            $user->city = $request->city;
            $user->pincode = $request->pincode;
            $user->country = $request->country;
            $user->state = $request->state;
            $user->save();

            Session::flash('successMessage', 'Account Information Updated Successfully.');
            return redirect()->back();
        }

        return view('front.users.account')->with(compact('userDetails', 'countries'));
    }
}
