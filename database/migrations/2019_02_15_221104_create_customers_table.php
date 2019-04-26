<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('phone');
			$table->string('address')->nullable();
			$table->string('city')->nullable();
			$table->string('province')->nullable();
			$table->string('country')->nullable();
			$table->string('postal_code')->nullable();
			$table->string('email')->nullable();
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
		Schema::dropIfExists('customers');
	}
}
