<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderStatus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        return view('admin.order_details', compact('order', 'customer', 'orderStatuses'));
    }

    function updateOrderStatus(Request $request) {
        Order::where('id', $request->order_id)->update(['order_status' => $request->order_status]);
        Session::flash('successMessage', 'Order status has been updated successfully.');
        return redirect()->back();
    }
}
