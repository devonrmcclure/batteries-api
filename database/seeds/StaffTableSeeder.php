<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff')->insert([
            'name' => Str::random(10),
            'initials' => Str::random(2),
            'location_id' => 1
        ]);

        DB::table('staff')->insert([
            'name' => Str::random(10),
            'initials' => Str::random(2),
            'location_id' => 2
        ]);
    }
}
