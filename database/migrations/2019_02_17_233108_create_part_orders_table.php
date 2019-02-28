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
            $table->string('reffered_by');
            $table->string('brand');
            $table->string('model');
            $table->unsignedInteger('staff_id');
            $table->unsignedInteger('customer_id');
            $table->timestamp('to_ho');
            $table->timestamp('from_ho');
            $table->timestamp('picked_up');
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
        Schema::dropIfExists('part_orders');
    }
}
