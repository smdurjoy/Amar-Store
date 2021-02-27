<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('state')->nullable();;
            $table->string('country')->nullable();;
            $table->string('pincode')->nullable();;
            $table->string('mobile');
            $table->string('email');
            $table->float('shipping_charges');
            $table->string('coupon_code')->nullable();;
            $table->float('coupon_amount')->nullable();;
            $table->string('order_status');
            $table->string('payment_method');
            $table->string('payment_gateway');
            $table->float('grand_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
