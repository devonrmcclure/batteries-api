<?php

use Illuminate\Database\Seeder;

class PartOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PartOrder::class, 10)->create();
    }
}
