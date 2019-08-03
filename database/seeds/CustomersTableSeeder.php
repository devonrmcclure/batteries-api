<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customers')->delete();
        
        \DB::table('customers')->insert(array (
            0 => 
            array (
                'id' => 3,
                'name' => 'Guildford Customer',
                'phone' => '6049309889',
                'address' => '15277 100 Ave Surrey BC',
                'city' => 'Surrey',
                'province' => 'British Columbia',
                'country' => 'Canada',
                'postal_code' => NULL,
                'email' => 'guildford@batteriesincluded.ca',
                'type' => 'default',
                'location_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ),
            1 => 
            array (
                'id' => 4,
                'name' => 'White Rock Customer',
                'phone' => '6045368108',
                'address' => '1711 152nd Street Surrey BC',
                'city' => 'Surrey',
                'province' => 'British Columbia',
                'country' => 'Canada',
                'postal_code' => NULL,
                'email' => 'whiterock@batteriesincluded.ca',
                'type' => 'default',
                'location_id' => 2,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ),
        ));
        
        
    }
}