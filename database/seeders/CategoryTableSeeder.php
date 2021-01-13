<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [
            ['id' => 1, 'parent_id' => 0, 'section_id' => 1, 'category_name' => 'T-shirts', 'category_image' => '', 'category_discount' => 0, 'description' => '100% cotton comfortable t-shirt', 'url' => 't-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1],

            ['id' => 2, 'parent_id' => 1, 'section_id' => 1, 'category_name' => 'Formal T-shirts', 'category_image' => '', 'category_discount' => 0, 'description' => '100% cotton comfortable t-shirt', 'url' => 'formal-t-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1],

            ['id' => 3, 'parent_id' => 1, 'section_id' => 1, 'category_name' => 'Casual T-shirts', 'category_image' => '', 'category_discount' => 0, 'description' => '100% cotton comfortable t-shirt', 'url' => 'casual-t-shirts', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1]
        ];

        Category::insert($categoryRecords);
    }
}
