<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku');
            $table->string('description');
            $table->integer('unit_price');
            $table->integer('unit_sale_price');
            $table->boolean('pst');
            $table->boolean('gst');
            $table->string('image');
            $table->string('brand');
            $table->string('manufacturer');
            $table->string('model_number');
            $table->string('order_number');
            $table->integer('last_purchase_vendor')->nullable();
            $table->integer('current_purchase_vendor')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
