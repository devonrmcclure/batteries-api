<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_number')->unique();
            $table->integer('subtotal');
            $table->integer('pst');
            $table->integer('gst');
            $table->integer('total');
            $table->integer('items_sold');
            $table->string('invoice_comment');
            $table->boolean('printed');
            $table->string('sale_type')->default('regular');
            $table->unsignedInteger('staff_id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('location_id');
            $table->unsignedInteger('payment_method');
            $table->unsignedInteger('part_order_id')->nullable();
            $table->unsignedInteger('repair_order_id')->nullable();
            $table->timestamp('duplicate_printed')->nullable();
            $table->timestamps();

            $table->foreign('staff_id')->references('id')->on('staff')->onUpdate('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('payment_method')->references('id')->on('payment_methods');
            $table->foreign('part_order_id')->references('id')->on('part_orders');
            $table->foreign('repair_order_id')->references('id')->on('repair_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
