<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\DeliveryAddress;

class DeliveryAddress extends Model
{
    use HasFactory;

    public static function deliveryAddresses() {
        $user_id = Auth::user()->id;
        $deliveryAddresses = DeliveryAddress::where('user_id', $user_id)->get()->toArray();
        return $deliveryAddresses;
    }
}
