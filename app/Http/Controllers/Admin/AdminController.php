<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index() {
        return view('admin.dashboard');
    }

    function login() {
        return view('admin.login');
    }
}
