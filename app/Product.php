<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductsAttribute;

class Product extends Model
{
    function category() {
        return $this->belongsTo('App\Category', 'category_id')->select(['id', 'category_name', 'url']);
    }

    function section() {
        return $this->belongsTo('App\Section', 'section_id')->select(['id', 'name']);
    }

    function brand() {
        return $this->belongsTo('App\Brand', 'brand_id');
    }

    function attributes() {
        return $this->hasMany('App\ProductsAttribute');
    }

    function images() {
        return $this->hasMany('App\ProductsImage');
    }

    public static function getDiscountedPrice($product_id) {
        $proDetails = Product::where('id', $product_id)->select('product_price', 'category_id', 'product_discount')->first()->toArray();
        
        $catDetails = Category::where('id', $proDetails['category_id'])->select('category_discount')->first()->toArray();

        if($proDetails['product_discount'] > 0) {
            // if product discount is added from admin panel
            $discounted_price = $proDetails['product_price'] - ($proDetails['product_price'] * $proDetails['product_discount'] / 100);
        } else if($catDetails['category_discount'] > 0) {
            // if product discount is not added and category discount is added from admin panel
            $discounted_price = $proDetails['product_price'] - ($proDetails['product_price'] * $catDetails['category_discount'] / 100);
        } else {
            $discounted_price = 0;
        }
        return round($discounted_price);
    }

    public static function getDiscountedAttrPrice($product_id, $size) {
        $proAttrPrice = ProductsAttribute::where(['product_id' => $product_id, 'size' => $size])->first()->toArray();

        $proDetails = Product::where('id', $product_id)->select('category_id', 'product_discount')->first()->toArray();
        
        $catDetails = Category::where('id', $proDetails['category_id'])->select('category_discount')->first()->toArray();

        if($proDetails['product_discount'] > 0) {
            // if product discount is added from admin panel
            $discounted_price = $proAttrPrice['price'] - ($proAttrPrice['price'] * $proDetails['product_discount'] / 100);
        } else if($catDetails['category_discount'] > 0) {
            // if product discount is not added and category discount is added from admin panel
            $discounted_price = $proAttrPrice['price'] - ($proAttrPrice['price'] * $catDetails['category_discount'] / 100);
        } else {
            $discounted_price = 0;
        }
        return array('product_price' => $proAttrPrice['price'], 'discounted_price' => round($discounted_price));
    }
}
