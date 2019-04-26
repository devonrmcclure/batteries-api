<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnHandQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('on_hand_quantities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('location_id');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('on_hand_quantities');
    }
}
