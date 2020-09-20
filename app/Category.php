<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    function subCategories() {
        return $this->hasMany('App\Category', 'parent_id')->where('status', 1);
    }

    function section() {
        return $this->belongsTo('App\Section', 'section_id')->select('id', 'name');
    }

    function parentCategory() {
        return $this->belongsTo('App\Category', 'parent_id')->select('id', 'category_name');
    }

    public static function categoryDetails($url) {
        $categoryDetails = Category::where(['url' => $url, 'status' => 1])->select('id', 'category_name', 'url', 'description')->with(['subCategories' => function($query) {
            $query->select('id', 'parent_id', 'category_name', 'url', 'description');
        }])->first()->toArray();
        $catIds = array();
        $catIds[] = $categoryDetails['id'];
        foreach($categoryDetails['sub_categories'] as $key => $subCat) {
            $catIds[] = $subCat['id'];
        }
        return array('catIds' => $catIds, 'categoryDetails' => $categoryDetails);
    }
}
