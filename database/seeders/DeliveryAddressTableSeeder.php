<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\DeliveryAddress;

class DeliveryAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryAddressRecords = [
            ['id' => 1, 'user_id' => 1, 'name' => 'Saqlain Mustaq', 'address' => 'East Guptapara, Rangpur', 'city' => 'Rangpur', 'state' => 'Rangpur', 'country' => 'Bangladesh', 'pincode' => '5400', 'mobile' => '01784996428', 'status' => 1],

            ['id' => 2, 'user_id' => 1, 'name' => 'Saqlain Mustaq', 'address' => 'Nurpur, Rangpur', 'city' => 'Rangpur', 'state' => 'Rangpur', 'country' => 'Bangladesh', 'pincode' => '5400', 'mobile' => '01646614411', 'status' => 1]
        ];  

        DeliveryAddress::insert($deliveryAddressRecords);
    }
}
