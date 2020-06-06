<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    function categories() {
        return $this->hasMany('App\Category', 'section_id')->where(['parent_id' =>0, 'status' =>1])->with('subCategories');
    }
}
