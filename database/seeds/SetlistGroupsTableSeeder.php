<?php

use Illuminate\Database\Seeder;

class SetlistGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('setlist_groups')->delete();
        
        \DB::table('setlist_groups')->insert(array (
            0 => 
            array (
                'setlist_id' => 8,
                'setlist_group_seq' => 0,
                'setlist_group_type' => 0,
                'created_at' => '2019-05-28 16:26:45',
                'updated_at' => '2019-05-28 16:26:45',
            ),
            1 => 
            array (
                'setlist_id' => 9,
                'setlist_group_seq' => 0,
                'setlist_group_type' => 0,
                'created_at' => '2019-06-07 17:22:51',
                'updated_at' => '2019-06-07 17:22:51',
            ),
            2 => 
            array (
                'setlist_id' => 10,
                'setlist_group_seq' => 0,
                'setlist_group_type' => 0,
                'created_at' => '2019-06-07 17:28:55',
                'updated_at' => '2019-06-07 17:28:55',
            ),
            3 => 
            array (
                'setlist_id' => 11,
                'setlist_group_seq' => 0,
                'setlist_group_type' => 0,
                'created_at' => '2019-06-13 19:41:44',
                'updated_at' => '2019-06-13 19:41:44',
            ),
        ));
        
        
    }
}