<?php

use Illuminate\Database\Seeder;
use App\ProductFilter;

class ProductFiltersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productFilterRecords = [
            ['id' => 1, 'filter_name' => 'fabric', 'filter_value' => 'Cotton'],
            ['id' => 2, 'filter_name' => 'fabric', 'filter_value' => 'Polyester'],
            ['id' => 3, 'filter_name' => 'fabric', 'filter_value' => 'Wool'],
            ['id' => 4, 'filter_name' => 'sleeve', 'filter_value' => 'Full Sleeve'],
            ['id' => 5, 'filter_name' => 'sleeve', 'filter_value' => 'Half Sleeve'],
            ['id' => 6, 'filter_name' => 'sleeve', 'filter_value' => 'Short Sleeve'],
            ['id' => 7, 'filter_name' => 'sleeve', 'filter_value' => 'SleeveLess'],
            ['id' => 8, 'filter_name' => 'pattern', 'filter_value' => 'Checked'],
            ['id' => 9, 'filter_name' => 'pattern', 'filter_value' => 'Plain'],
            ['id' => 10, 'filter_name' => 'pattern', 'filter_value' => 'Printed'],
            ['id' => 11, 'filter_name' => 'pattern', 'filter_value' => 'Self'],
            ['id' => 12, 'filter_name' => 'pattern', 'filter_value' => 'Solid'],
            ['id' => 13, 'filter_name' => 'fit', 'filter_value' => 'Regular'],
            ['id' => 14, 'filter_name' => 'fit', 'filter_value' => 'Slim'],
            ['id' => 15, 'filter_name' => 'occasion', 'filter_value' => 'Formal'],
            ['id' => 16, 'filter_name' => 'occasion', 'filter_value' => 'Casual'],
        ];

        ProductFilter::insert($productFilterRecords);
    }
}
