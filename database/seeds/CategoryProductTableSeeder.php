<?php

use Illuminate\Database\Seeder;

class CategoryProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$categories = \App\Category::all();
		$products = \App\Product::all();

		foreach ($categories as $category) {
			foreach ($products as $product) {
				if (rand(1, 10) > 5) {
					DB::table('category_product')->insert([
						'category_id' => $category->id,
						'product_id' => $product->id
					]);
				}
			}
		}
    }
}
