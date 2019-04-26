<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_orders', function (Blueprint $table) {   
            $table->increments('id');
            $table->unsignedInteger('order_number');
            $table->boolean('warranty');
            $table->string('warranty_type')->nullable();
            $table->integer('call_if_over')->nullable();
            $table->string('referred_by');
            $table->string('brand');
            $table->string('model');
            $table->string('type')->nullable();
            $table->string('date_code')->nullable();
            $table->string('condition');
            $table->string('accessories');
            $table->text('customer_problem');
            $table->string('store_notes')->nullable();
            $table->text('technician_notes')->nullable();
            $table->unsignedInteger('staff_id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('location_id');
            $table->timestamp('to_ho')->nullable();
            $table->timestamp('from_ho')->nullable();
            $table->timestamp('picked_up')->nullable();
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
        Schema::dropIfExists('repair_orders');
    }
}
