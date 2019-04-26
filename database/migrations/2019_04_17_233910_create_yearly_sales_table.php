<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearlySalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yearly_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year_ending'); // EG: Feb 29th
            $table->integer('cash');
            $table->integer('cash_pst');
            $table->integer('cash_gst');
            $table->integer('visa');
            $table->integer('visa_pst');
            $table->integer('visa_gst');
            $table->integer('mc');
            $table->integer('mc_pst');
            $table->integer('mc_gst');
            $table->integer('other');
            $table->integer('other_pst');
            $table->integer('other_gst');
            $table->integer('pre_tax_total');
            $table->integer('total_pst');
            $table->integer('total_gst');
            $table->integer('with_tax_total');
            $table->integer('total_invoices');
            $table->integer('items_sold');
            $table->unsignedInteger('location_id');
            $table->timestamps();

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
        Schema::dropIfExists('yearly_sales');
    }
}
