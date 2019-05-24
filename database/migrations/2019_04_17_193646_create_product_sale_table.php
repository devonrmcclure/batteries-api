<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sale', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku');
            $table->integer('price');
            $table->string('description');
            $table->integer('quantity');
            $table->integer('extended');
            $table->integer('pst');
            $table->integer('gst');
            $table->integer('total');
            $table->text('comment');
            $table->string('sale_type')->default('regular');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('sale_id');
            $table->unsignedInteger('location_id');

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('sale_id')->references('id')->on('sales');
            $table->foreign('location_id')->references('id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_sale');
    }
}
