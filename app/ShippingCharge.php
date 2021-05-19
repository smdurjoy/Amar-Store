<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    use HasFactory;

    public static function getShippingCharge($country, $weight) {
        $shippingDetails = ShippingCharge::where('country', $country)->first()->toArray();
        if($weight > 0) {
            if($weight > 0 && $weight <= 500) {
                $shippingCharge = $shippingDetails['0_500g'];
            }else if($weight > 500 && $weight <= 1000) {
                $shippingCharge = $shippingDetails['501_1000g'];
            }else if($weight > 1000 && $weight <= 2000) {
                $shippingCharge = $shippingDetails['1001_2000g'];
            }else if($weight > 2000 && $weight <= 5000) {
                $shippingCharge = $shippingDetails['2001_5000g'];
            }else if($weight > 5000) {
                $shippingCharge = $shippingDetails['above_5000g'];
            }
        }else {
            $shippingCharge = 0;
        }
        return $shippingCharge;
    }
}
