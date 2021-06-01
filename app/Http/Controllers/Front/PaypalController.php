<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Order;
use App\Sms;
use Illuminate\Support\Facades\Mail;

class PaypalController extends Controller
{
    function index() {
        if(Session::has('order_id')) {
            $orderDetails = Order::where('id', Session::get('order_id'))->first()->toArray();
            $nameArr = explode(' ', $orderDetails['name']);
            return view('front.paypal.paypal', compact('orderDetails', 'nameArr'));
        }
        return abort(404);
    }

    function success() {
        if(Session::has('order_id')) {
            Cart::where('user_id', Auth::user()->id)->delete();
            return view('front.paypal.success');
        }
        return abort(404);
    }

    function fail() {
        return view('front.paypal.fail');
    }

    function ipn(Request $request) {
        $data = $request->all();
        if ($data['payment_status'] == "Completed") {
            // Process the order
            $order_id = Session::get('order_id');
            Order::where('id', $order_id)->update(['order_status' => 'Paid']);
            // Send order sms
            $message = "Dear customer, your order #".$order_id." has been successfully placed with ecom.smdurjoy.com. We will intimate you once your order is shipped.";
            $number = Auth::user()->mobile;
            Sms::sendSms($message, $number);        

            $orderDetails = Order::where('id', $order_id)->with('order_products')->first();

            // Send order email
            $email = Auth::user()->email;
            $messageData = [
                'email' => $email,
                'name' => Auth::user()->name,
                'order_id' => $order_id,
                'orderDetails' => $orderDetails,
            ];  

            Mail::send('emails.order', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('Order Placed - ecom.smdurjoy.com');
            });
        }
        return abort(404);
    }
}
