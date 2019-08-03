<?php

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('locations')->delete();
        
        \DB::table('locations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'name' => 'Guildford',
                'email' => 'guildford@batteriesincluded.ca',
                'phone' => '6049309889',
                'address' => '15277 100 Ave Surrey BC',
                'password' => bcrypt('secret'),
                'remember_token' => NULL,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'name' => 'White Rock',
                'email' => 'whiterock@batteriesincluded.ca',
                'phone' => '6045368108',
                'address' => '1711 152nd Street Surrey BC',
                'password' => bcrypt('secret'),
                'remember_token' => NULL,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ),
        ));
        
        
    }
}