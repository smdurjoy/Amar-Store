<?php

use Illuminate\Database\Seeder;
use App\Product;

class productsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            ['id' => 1, 'category_id' => 9, 'section_id' => 1, 'product_name' => 'Blue t-shirt', 'product_code' => 'BT001', 'product_color' => 'Blue', 'product_price' => 999, 'product_discount' => 60, 'product_weight' => 200, 'product_video' => '', 'product_image' => '', 'product_description' => '', 'wash_care' =>'', 'fabric' => '', 'pattern' => '', 'sleeve' => '', 'fit' => '', 'occasion' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'is_featured' => 'No', 'status' => 1],

            ['id' => 2, 'category_id' => 9, 'section_id' => 1, 'product_name' => 'Red t-shirt', 'product_code' => 'RT001', 'product_color' => 'Red', 'product_price' => 1199, 'product_discount' => 100, 'product_weight' => 200, 'product_video' => '', 'product_image' => '', 'product_description' => '', 'wash_care' =>'', 'fabric' => '', 'pattern' => '', 'sleeve' => '', 'fit' => '', 'occasion' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'is_featured' => '', 'status' => 1],

            ['id' => 3, 'category_id' => 9, 'section_id' => 1, 'product_name' => 'Green t-shirt', 'product_code' => 'GT001', 'product_color' => 'Blue', 'product_price' => 699, 'product_discount' => 0, 'product_weight' => 200, 'product_video' => '', 'product_image' => '', 'product_description' => '', 'wash_care' =>'', 'fabric' => '', 'pattern' => '', 'sleeve' => '', 'fit' => '', 'occasion' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'is_featured' => '', 'status' => 1]
        ];

        Product::insert($productRecords);
    }
}
