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
		$this->call(PartOrderTableSeeder::class);
		//Reapir order (Y)
		//Sales (Y)
		//Products_Sales (pivot between products and sales) (y)
		// Associated_Skus (for auto adding eco fee and whatnot)
		//PartOrderSales (y)
		//RepairOrderSales (Y)
		//DailyClosings (Y)
		//MonthlySales (Y)
		//YearlySales (Y)
		//OnHandQuantities (Y)
		//Sales_Settings
	}
}
