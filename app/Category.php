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
}
