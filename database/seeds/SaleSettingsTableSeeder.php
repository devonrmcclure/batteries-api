<?php

use Illuminate\Database\Seeder;

class SaleSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sale_settings')->delete();
        
        \DB::table('sale_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'pst_rate' => 7,
                'gst_rate' => 5,
            ),
        ));
        
        
    }
}