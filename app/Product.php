<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    function category() {
        return $this->belongsTo('App\Category', 'category_id')->select(['id', 'category_name']);
    }

    function section() {
        return $this->belongsTo('App\Section', 'section_id')->select(['id', 'name']);
    }
}