<?php

use App\ProductsAttribute;
use Illuminate\Database\Seeder;

class ProductsAttrTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsAttrRecords = [
            ['id' => 1, 'product_id' => 1, 'size' => 'Small', 'price' => 1100, 'stock' => 10, 'sku' => 'BT001-S', 'status' => 1],
            ['id' => 2, 'product_id' => 1, 'size' => 'Medium', 'price' => 1200, 'stock' => 14, 'sku' => 'BT001-M', 'status' => 1],
            ['id' => 3, 'product_id' => 1, 'size' => 'Large', 'price' => 1300, 'stock' => 10, 'sku' => 'BT001-L', 'status' => 1]
        ];

        ProductsAttribute::insert($productsAttrRecords);
    }
}
