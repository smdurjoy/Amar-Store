<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    function subCategories(): HasMany
    {
        return $this->hasMany('App\Category', 'parent_id')->where('status', 1);
    }

    function section(): BelongsTo
    {
        return $this->belongsTo('App\Section', 'section_id')->select('id', 'name');
    }

    function parentCategory(): BelongsTo
    {
        return $this->belongsTo('App\Category', 'parent_id')->select('id', 'category_name');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public static function categoryDetails($url) {
        $categoryDetails = Category::where(['url' => $url, 'status' => 1])->select('id', 'parent_id', 'category_name', 'url', 'description')->with(['subCategories' => function($query) {
            $query->select('id', 'parent_id', 'category_name', 'url', 'description');
        }])->first()->toArray();

        if($categoryDetails['parent_id'] == 0) {
            $breadcrumbs = '<a href="'.url($categoryDetails['url']).'">'.$categoryDetails['category_name'].'</a>';
        } else {
            $parentCategory = Category::where('id', $categoryDetails['parent_id'])->select('category_name', 'url')->first()->toArray();
            $breadcrumbs = '<a href="'.url($parentCategory['url']).'">'.$parentCategory['category_name'].'</a><span class="divider">/</span><a href="'.url($categoryDetails['url']).'">'.$categoryDetails['category_name'].'</a>';
        }

        $catIds = array();
        $catIds[] = $categoryDetails['id'];
        foreach($categoryDetails['sub_categories'] as $key => $subCat) {
            $catIds[] = $subCat['id'];
        }
        return array('catIds' => $catIds, 'categoryDetails' => $categoryDetails, 'breadcrumbs' => $breadcrumbs);
    }
}
