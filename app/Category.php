<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    function subCategories() {
        return $this->hasMany('App\Category', 'parent_id')->where('status', 1);
    }
}
