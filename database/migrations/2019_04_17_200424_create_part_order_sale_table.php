<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartOrderSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_order_sale', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('part_order_id');
            $table->unsignedInteger('sale_id');
            $table->timestamps();

            $table->foreign('part_order_id')->references('id')->on('part_orders');
            $table->foreign('sale_id')->references('id')->on('sales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('part_order_sale');
    }
}
