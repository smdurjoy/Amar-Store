<?php

use Illuminate\Database\Seeder;
use App\ProductsImage;

class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsImageRecords = [
            ['id' => 1, 'product_id' => 1, 'image' => 'red-tShirtBack.jpg', 'status' => 1]
        ];
        
        ProductsImage::insert($productsImageRecords);
    }
}
