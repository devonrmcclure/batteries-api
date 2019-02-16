<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call(UsersTableSeeder::class);
		$this->call(LocationsTableSeeder::class);
		$this->call(CategoryTableSeeder::class);
		$this->call(ProductTableSeeder::class);
    //$this->call(CategoryProductTableSeeder::class);
		$this->call(StaffTableSeeder::class);
		$this->call(CustomerTableSeeder::class);
	}
}
