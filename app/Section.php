<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public static function section() {
        $sections = Section::with('categories')->where('status', 1)->get();
        $sections = json_decode(json_encode($sections), true);
        return $sections;
    }

    function categories() {
        return $this->hasMany('App\Category', 'section_id')->where(['parent_id' =>"ROOT", 'status' =>1])->with('subCategories');
    }
}
