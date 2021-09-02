<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;

class OrdersController extends Controller
{
    function index() {
        $orders = Order::where('user_id', Auth::user()->id)->where('status', 1)->with('order_products')->orderBy('id', 'desc')->get()->toArray();
        return view('front.orders.orders', compact('orders'));
    }

    function orderDetails($id) {
        $order = Order::where('id', $id)->with('order_products')->first();
        return view('front.orders.order_details', compact('order'));
    }

    function unconfirmedOrders() {
        $orders = Order::where('user_id', Auth::user()->id)->where('status', 0)->with('order_products')->orderBy('id', 'desc')->get()->toArray();
        return view('front.orders.unconfirmed', compact('orders'));
    }
}
