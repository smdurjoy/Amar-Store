<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderStatus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Sms;
use Illuminate\Support\Facades\Mail;
use App\OrdersLog;
use PDF;

class OrdersController extends Controller
{
    function index() {
        Session::put('page', 'orders');
        $orders = Order::with('order_products')->orderBy('id', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }

    function orderDetails($id) {
        $order = Order::with('order_products')->where('id', $id)->first();
        $customer = User::where('id', $order->user_id)->first();
        $orderStatuses = OrderStatus::where('status', 1)->get();
        $orderLogs = OrdersLog::where('order_id', $id)->orderBy('id', 'desc')->get()->toArray();
        return view('admin.order_details', compact('order', 'customer', 'orderStatuses', 'orderLogs'));
    }

    function updateOrderStatus(Request $request) {
        Order::where('id', $request->order_id)->update(['order_status' => $request->order_status]);

        if(!empty($request->courier_name) && !empty($request->tracking_number)) {
            Order::where('id', $request->order_id)->update(['courier_name' => $request->courier_name, 'tracking_number' => $request->tracking_number]);
        }

        Session::flash('successMessage', 'Order status has been updated successfully.');

        $deliveryDetails = Order::select('mobile', 'email', 'name')->where('id', $request->order_id)->first();

        // Send order status update sms
        // $message = "Dear customer, Your order #".$request->order_id." status has been updated to '".$request->order_status."' placed with ecom.smdurjoy.com.";
        // $mobile = $deliveryDetails->mobile;
        // Sms::sendSms($message, $mobile);

        // Send order status update email
        $orderDetails = Order::where('id', $request->order_id)->with('order_products')->first();

        // Send order email
        $email = $deliveryDetails->email;
        $messageData = [
            'email' => $email,
            'name' => $deliveryDetails->name,
            'order_id' => $request->order_id,
            'order_status' => $request->order_status,
            'orderDetails' => $orderDetails,
            'courier_name' => $request->courier_name,
            'tracking_number' => $request->tracking_number,
        ];  

        Mail::send('emails.order_status', $messageData, function ($message) use ($email) {
            $message->to($email)->subject('Order Status Updated - ecom.smdurjoy.com');
        });

        // Order log
        $log = new OrdersLog;
        $log->order_id = $request->order_id;
        $log->order_status = $request->order_status;
        $log->save();   

        return redirect()->back();
    }

    function viewOrderInvoice($order_id) {
        $order = Order::with('order_products')->where('id', $order_id)->first();   
        $user = User::where('id', $order->user_id)->first();
        $pdf = PDF::loadView('pdf.order_invoice_pdf', $order);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}   
