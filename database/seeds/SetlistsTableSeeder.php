<?php

use Illuminate\Database\Seeder;

class SetlistsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('setlists')->delete();
        
        \DB::table('setlists')->insert(array (
            0 => 
            array (
                'setlist_id' => 8,
                'event_id' => 14,
                'artist_id' => 1,
                'created_at' => '2019-05-28 16:26:45',
                'updated_at' => '2019-05-28 16:26:45',
            ),
            1 => 
            array (
                'setlist_id' => 9,
                'event_id' => 15,
                'artist_id' => 1,
                'created_at' => '2019-06-07 17:22:51',
                'updated_at' => '2019-06-07 17:22:51',
            ),
            2 => 
            array (
                'setlist_id' => 10,
                'event_id' => 16,
                'artist_id' => 1,
                'created_at' => '2019-06-07 17:28:55',
                'updated_at' => '2019-06-07 17:28:55',
            ),
            3 => 
            array (
                'setlist_id' => 11,
                'event_id' => 17,
                'artist_id' => 1,
                'created_at' => '2019-06-13 19:41:44',
                'updated_at' => '2019-06-13 19:41:44',
            ),
        ));
        
        
    }
}