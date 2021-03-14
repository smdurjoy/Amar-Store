<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
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
        return view('admin.order_details', compact('order', 'customer'));
    }
}
