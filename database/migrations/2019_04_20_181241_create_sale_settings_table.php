<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Both PST and GST rate are stored as a value from 0-100.
        Schema::create('sale_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pst_rate'); 
            $table->integer('gst_rate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_settings');
    }
}
