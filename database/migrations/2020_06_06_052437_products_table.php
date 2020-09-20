<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->integer('section_id');
            $table->string('product_name');
            $table->string('product_code');
            $table->string('product_color');
            $table->float('product_price');
            $table->float('product_discount')->nullable();
            $table->float('product_weight')->nullable();
            $table->string('product_video')->nullable();
            $table->string('product_image')->nullable();
            $table->text('product_description')->nullable();
            $table->string('wash_care')->nullable();
            $table->string('fabric')->nullable();
            $table->string('pattern')->nullable();
            $table->string('sleeve')->nullable();
            $table->string('fit')->nullable();
            $table->string('occasion')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->enum('is_featured',['Yes', 'No']);
            $table->tinyInteger('status');
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
        //
    }
}
