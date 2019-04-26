<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleRepairOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_repair_order', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('repair_order_id');
            $table->unsignedInteger('sale_id');
            $table->timestamps();

            $table->foreign('repair_order_id')->references('id')->on('repair_orders');
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
        Schema::dropIfExists('sale_repair_order');
    }
}
