<?php

use Illuminate\Database\Seeder;

class ArtistsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('artists')->delete();
        
        \DB::table('artists')->insert(array (
            0 => 
            array (
                'artist_id' => 1,
                'name' => 'GARNiDELiA',
                'link' => NULL,
                'edit_user_id' => 0,
                'created_at' => '2019-10-08 07:31:27',
                'updated_at' => '2019-10-08 07:31:27',
            ),
        ));
        
        
    }
}