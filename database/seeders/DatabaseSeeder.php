<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([
        //     AdminTableSeeder::class,
        //     CategoryTableSeeder::class,
        //     ProductsAttrTableSeeder::class,
        //     productsTableSeeder::class,
        //     SectionsTableSeeder::class,
        // ]);
        // $this->call(ProductsImagesTableSeeder::class);
        // $this->call(BrandsTableSeeder::class);
//        $this->call(BannersTableSeeder::class);
        // $this->call(ProductFiltersTableSeeder::class);
        // $this->call(CouponsTableSeeder::class);
        $this->call(DeliveryAddressTableSeeder::class);
    }
}
