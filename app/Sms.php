<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    use HasFactory;

    public static function sendSms($msg, $number) {
        $username = "smdurjoy";
        $hash = "475e039a9f70a0c42a0ea2036d910476"; //generate token from the control panel
        $numbers = $number; //Recipient Phone Number multiple number must be separated by comma
        $message = $msg;

        $params = array('u'=>$username, 'h'=>$hash, 'op'=>'pv', 'to'=>$numbers, 'msg'=>$message);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://alphasms.biz/index.php?app=ws");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        curl_close ($ch);
    }
}
