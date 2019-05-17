<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_number');
            $table->string('referred_by');
            $table->string('brand');
            $table->string('model');
            $table->string('item');
            $table->string('part_number');
            $table->string('part_description');
            $table->string('notes')->nullable();
            $table->unsignedInteger('staff_id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('location_id');
            $table->timestamp('to_ho')->nullable(); //Default as time of order
            $table->timestamp('from_ho')->nullable();
            $table->timestamp('picked_up')->nullable();
            $table->timestamp('voided_at')->nullable();
            $table->timestamps();

            $table->foreign('staff_id')->references('id')->on('staff');
            $table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('part_orders');
    }
}
