<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductsAttribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    function category(): BelongsTo
    {
        return $this->belongsTo('App\Category', 'category_id')->select(['id', 'category_name', 'url']);
    }

    function section(): BelongsTo
    {
        return $this->belongsTo('App\Section', 'section_id')->select(['id', 'name']);
    }

    function brand(): BelongsTo
    {
        return $this->belongsTo('App\Brand', 'brand_id');
    }

    function attributes(): HasMany
    {
        return $this->hasMany('App\ProductsAttribute');
    }

    function images(): HasMany
    {
        return $this->hasMany('App\ProductsImage');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public static function getDiscountedPrice($product_id): float
    {
        $proDetails = Product::where('id', $product_id)->select('product_price', 'category_id', 'product_discount')->first()->toArray();

        $catDetails = Category::where('id', $proDetails['category_id'])->select('category_discount')->first()->toArray();

        if ($proDetails['product_discount'] > 0) {
            // if product discount is added from admin panel
            $discounted_price = $proDetails['product_price'] - ($proDetails['product_price'] * $proDetails['product_discount'] / 100);
        } else if ($catDetails['category_discount'] > 0) {
            // if product discount is not added and category discount is added from admin panel
            $discounted_price = $proDetails['product_price'] - ($proDetails['product_price'] * $catDetails['category_discount'] / 100);
        } else {
            $discounted_price = 0;
        }
        return round($discounted_price);
    }

    public static function getDiscountedAttrPrice($product_id, $size)
    {
        $proAttrPrice = ProductsAttribute::where(['product_id' => $product_id, 'size' => $size])->first()->toArray();

        $proDetails = Product::where('id', $product_id)->select('category_id', 'product_discount')->first()->toArray();

        $catDetails = Category::where('id', $proDetails['category_id'])->select('category_discount')->first()->toArray();

        if ($proDetails['product_discount'] > 0) {
            // if product discount is added from admin panel
            $final_price = $proAttrPrice['price'] - ($proAttrPrice['price'] * $proDetails['product_discount'] / 100);
            $discount = $proAttrPrice['price'] - $final_price;
        } else if ($catDetails['category_discount'] > 0) {
            // if product discount is not added and category discount is added from admin panel
            $final_price = $proAttrPrice['price'] - ($proAttrPrice['price'] * $catDetails['category_discount'] / 100);
            $discount = $proAttrPrice['price'] - $final_price;
        } else {
            $final_price = $proAttrPrice['price'];
            $discount = 0;
        }
        return array('product_price' => $proAttrPrice['price'], 'final_price' => round($final_price), 'discount' => $discount);
    }

    public static function getProductImage($product_id)
    {
        return Product::where('id', $product_id)->select('product_image')->first()->product_image;
    }
}
