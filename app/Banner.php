<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public static function getBanners() {
        $banners = Banner::where('status', 1)->get()->toArray();
        return $banners;
    }
}
