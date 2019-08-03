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
		$this->call(StaffTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
		$this->call(CategoryTableSeeder::class);
		$this->call(ProductsTableSeeder::class);
	    $this->call(ProductsTableSeeder::class);
        $this->call(PaymentMethodsTableSeeder::class);
        $this->call(SaleSettingsTableSeeder::class);
    }
}
