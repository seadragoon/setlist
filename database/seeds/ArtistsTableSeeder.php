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
                'edit_user_id' => 1,
                'created_at' => '2019-11-22 04:51:09',
                'updated_at' => '2019-11-22 04:51:09',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'artist_id' => 2,
                'name' => 'ピコ',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-22 22:58:03',
                'updated_at' => '2019-11-22 22:58:03',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'artist_id' => 3,
                'name' => 'TrySail',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-22 23:11:47',
                'updated_at' => '2019-11-22 23:11:47',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'artist_id' => 4,
                'name' => 'LiSA',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-22 23:11:53',
                'updated_at' => '2019-11-22 23:11:53',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'artist_id' => 5,
                'name' => 'ClariS',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-22 23:12:42',
                'updated_at' => '2019-11-22 23:12:42',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'artist_id' => 6,
                'name' => 'EGOIST',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-22 23:33:28',
                'updated_at' => '2019-11-22 23:33:28',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'artist_id' => 7,
                'name' => '春奈るな',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-22 23:42:14',
                'updated_at' => '2019-11-22 23:42:14',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'artist_id' => 8,
                'name' => 'ELISA',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-22 23:42:23',
                'updated_at' => '2019-11-22 23:42:23',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'artist_id' => 9,
                'name' => '瀧川ありさ',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-22 23:42:32',
                'updated_at' => '2019-11-22 23:42:32',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'artist_id' => 10,
                'name' => 'supercell',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-22 23:42:43',
                'updated_at' => '2019-11-22 23:42:43',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'artist_id' => 11,
                'name' => '藍井エイル',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-22 23:44:46',
                'updated_at' => '2019-11-22 23:44:46',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'artist_id' => 12,
                'name' => 'じんP',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-23 14:33:54',
                'updated_at' => '2019-11-23 14:35:48',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'artist_id' => 13,
                'name' => 'CIVILIAN',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-23 14:37:06',
                'updated_at' => '2019-11-23 14:37:06',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}