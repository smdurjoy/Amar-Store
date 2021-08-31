<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Order;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PrepaidController extends Controller
{
    function ssl(Request $request) {
        $order = Order::where('id', $request->order)->with('order_products')->first();
        $product_names = [];
        $product_codes = [];
        foreach ($order->order_products as $product) {
            array_push($product_names, $product->product_name);
            array_push($product_codes, $product->product_code);
        }
        $post_data = array();
        $post_data['total_amount'] = $order->grand_total; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $order->name;
        $post_data['cus_email'] = $order->email;
        $post_data['cus_add1'] = $order->address;
        $post_data['cus_city'] = $order->city;
        $post_data['cus_state'] = $order->state;
        $post_data['cus_postcode'] = $order->pincode;
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $order->mobile;

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = $order->name;
        $post_data['ship_add1'] = $order->address;
        $post_data['ship_city'] = $order->city;
        $post_data['ship_state'] = $order->state;
        $post_data['ship_postcode'] = $order->pincode;
        $post_data['ship_phone'] = $order->mobile;
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = implode(', ', $product_names);
        $post_data['product_codes'] = implode(', ', $product_codes);
        $post_data['product_category'] = "Cloths";
        $post_data['product_profile'] = "cloth-goods";

        #Before  going to initiate the payment order status need to update as Pending.
        $transaction = new Transaction();
        $transaction->order_id = $request->order;
        $transaction->transaction_id = $post_data['tran_id'];
        $transaction->total_amount = $order->grand_total;
        $transaction->currency = 'BDT';
        $transaction->status = 'Pending';
        $transaction->save();

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

        Session::put('transaction', true);
    }

    public function success(Request $request) {
            $tran_id = $request->input('tran_id');
            $amount = $request->input('amount');
            $currency = $request->input('currency');
            $type = $request->input('card_issuer');
            $method = $request->input('card_brand');

            $sslc = new SslCommerzNotification();
            $transaction = DB::table('transactions')
                ->where('transaction_id', $tran_id)
                ->select('order_id', 'transaction_id', 'status', 'currency', 'total_amount')->first();

            $order = Order::where('id', $transaction->order_id)->first();
            $status = true;
            $message = "TRANSACTION HAS BEEN COMPLETED SUCCESSFULLY.";
            if ($transaction->status == 'Pending') {
                $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

                if ($validation == TRUE) {
                    /*
                    That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also send sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('transactions')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing', 'type' => $type, 'method' => $method]);

                    $order->status = 1;
                    $order->save();
                } else {
                    /*
                    That means IPN did not work or IPN URL was not set in your merchant panel and Transaction validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('transactions')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed', 'type' => $type, 'method' => $method]);
                    $message = "SOMETHING WENT WRONG.";
                    $status = false;
                }
            } else if ($transaction->status == 'Processing' || $transaction->status == 'Complete') {
                /*
                 That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to update database.
                 */
                $order->status = 1;
                $order->save();
            } else {
                #That means something wrong happened. You can redirect customer to your product page.
                $message = "SOMETHING WENT WRONG.";
                $status = false;
            }
            return view('front.sslcommerz.status', compact('message', 'status'));
    }

    public function fail(Request $request) {
        if (Session::has('transaction')) {
            $status = false;
            $tran_id = $request->input('tran_id');
            $transaction = DB::table('transactions')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'total_amount')->first();
            if ($transaction->status == 'Pending') {
                $update_product = DB::table('transactions')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                $message = "Transaction is failed";
            } else if ($transaction->status == 'Processing' || $transaction->status == 'Complete') {
                $message = "Transaction is already Successful";
            } else {
                $message = "Invalid Transaction";
            }
            return view('front.sslcommerz.status', compact('message', 'status'));
        }
        return abort(404);
    }

    public function cancel(Request $request) {
        if (Session::has('transaction')) {
            $status = false;
            $tran_id = $request->input('tran_id');
            $transaction = DB::table('transactions')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'total_amount')->first();

            if ($transaction->status == 'Pending') {
                $update_product = DB::table('transactions')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Canceled']);
                $message = "Transaction has been canceled!";
            } else if ($transaction->status == 'Processing' || $transaction->status == 'Complete') {
                $message = "Transaction is already Successful";
            } else {
                $message = "Invalid Transaction";
            }
            return view('front.sslcommerz.status', compact('message', 'status'));
        }
        return abort(404);
    }

    public function ipn(Request $request) {
        if (Session::has('transaction')) {
            #Received all the payement information from the gateway
            if ($request->input('tran_id')) #Check transation id is posted or not.
            {
                $tran_id = $request->input('tran_id');
                #Check order status in order tabel against the transaction id or order id.
                $order_details = DB::table('transactions')
                    ->where('transaction_id', $tran_id)
                    ->select('transaction_id', 'status', 'currency', 'total_amount')->first();

                if ($order_details->status == 'Pending') {
                    $sslc = new SslCommerzNotification();
                    $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                    if ($validation == TRUE) {
                        /*
                        That means IPN worked. Here you need to update order status
                        in order table as Processing or Complete.
                        Here you can also sent sms or email for successful transaction to customer
                        */
                        $update_product = DB::table('transactions')
                            ->where('transaction_id', $tran_id)
                            ->update(['status' => 'Processing']);

                        $status = true;
                        $message = "Transaction has been completed successfully.";
                    } else {
                        /*
                        That means IPN worked, but Transation validation failed.
                        Here you need to update order status as Failed in order table.
                        */
                        $update_product = DB::table('transactions')
                            ->where('transaction_id', $tran_id)
                            ->update(['status' => 'Failed']);

                        $status = false;
                        $message = "Validation Failed!";
                    }

                } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
                    #That means Order status already updated. No need to udate database.
                    $status = false;
                    $message = "Transaction is already successfully Completed";
                } else {
                    #That means something wrong happened. You can redirect customer to your product page.
                    $status = false;
                    $message = "Invalid Transaction";
                }
            } else {
                $status = false;
                $message = "Invalid Data";
            }
            return view('front.sslcommerz.status', compact('message', 'status'));
        }
        return abort(404);
    }
}
