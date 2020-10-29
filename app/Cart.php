<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;

    public static function userCartItems() {
        if(Auth::check()) {
            $userCartItems = Cart::with(['product' => function($query) {
                $query->select('id', 'product_name', 'product_color', 'product_code', 'product_image');
            }])->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get()->toArray();
        }else {
            $userCartItems = Cart::with(['product' => function($query) {
                $query->select('id', 'product_name', 'product_color', 'product_code', 'product_image');
            }])->where('session_id', Session::get('session_id'))->orderBy('id', 'desc')->get()->toArray();
        }
        return $userCartItems;
    }

    function product() {
        return $this->belongsTo('App\Product');
    }

    public static function getAttrPrice($productId, $size) {
        $attrPrice = ProductsAttribute::select('price')->where(['product_id' => $productId, 'size' => $size])->first();
        return $attrPrice->price;
    }
}
