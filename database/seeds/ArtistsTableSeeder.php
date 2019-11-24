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
            13 => 
            array (
                'artist_id' => 14,
                'name' => '綾野ましろ',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 03:32:24',
                'updated_at' => '2019-11-24 03:32:24',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'artist_id' => 15,
                'name' => 'アナタシア',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 13:19:51',
                'updated_at' => '2019-11-24 13:19:51',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'artist_id' => 16,
                'name' => 'COJIRASE THE TRIP',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 13:24:24',
                'updated_at' => '2019-11-24 13:24:24',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'artist_id' => 17,
                'name' => 'manaco',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 13:24:31',
                'updated_at' => '2019-11-24 13:24:31',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'artist_id' => 18,
                'name' => 'SHARE LOCK HOMES',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 13:24:46',
                'updated_at' => '2019-11-24 13:24:46',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'artist_id' => 19,
                'name' => 'kradness',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 13:24:55',
                'updated_at' => '2019-11-24 13:24:55',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'artist_id' => 20,
                'name' => 'やなぎなぎ',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 13:25:02',
                'updated_at' => '2019-11-24 13:25:02',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'artist_id' => 21,
                'name' => 'MeseMoa.',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 13:25:15',
                'updated_at' => '2019-11-24 13:25:15',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'artist_id' => 22,
                'name' => 'センラ',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 13:25:30',
                'updated_at' => '2019-11-24 13:25:30',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'artist_id' => 23,
                'name' => 'ボーカロイド',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 13:42:37',
                'updated_at' => '2019-11-24 13:42:37',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'artist_id' => 24,
                'name' => 'May\'n',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 16:19:40',
                'updated_at' => '2019-11-24 16:19:40',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'artist_id' => 25,
                'name' => 'May\'n/中島愛',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 16:21:13',
                'updated_at' => '2019-11-24 16:21:13',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'artist_id' => 26,
                'name' => 'TK from 凛として時雨',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 16:22:09',
                'updated_at' => '2019-11-24 16:22:09',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'artist_id' => 27,
                'name' => 'みうめ',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 16:25:24',
                'updated_at' => '2019-11-24 16:25:24',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'artist_id' => 28,
                'name' => '仮面ライアー217',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 16:25:33',
                'updated_at' => '2019-11-24 16:25:33',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'artist_id' => 29,
                'name' => 'DALI',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 16:26:10',
                'updated_at' => '2019-11-24 16:26:10',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'artist_id' => 30,
                'name' => '高橋洋子',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 16:26:45',
                'updated_at' => '2019-11-24 16:26:45',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'artist_id' => 31,
                'name' => 'MiA',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 16:36:34',
                'updated_at' => '2019-11-24 16:36:34',
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'artist_id' => 32,
                'name' => 'TRUE',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 21:25:11',
                'updated_at' => '2019-11-24 21:25:11',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'artist_id' => 33,
                'name' => 'OxT',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 21:26:13',
                'updated_at' => '2019-11-24 21:26:13',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'artist_id' => 34,
                'name' => 'ROMANTIC MODE',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 21:30:50',
                'updated_at' => '2019-11-24 21:30:50',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'artist_id' => 35,
                'name' => '中島愛',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 21:36:11',
                'updated_at' => '2019-11-24 21:36:11',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'artist_id' => 36,
                'name' => 'Folder5',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 21:42:57',
                'updated_at' => '2019-11-24 21:42:57',
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'artist_id' => 37,
                'name' => '井口裕香',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 21:43:26',
                'updated_at' => '2019-11-24 21:43:26',
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'artist_id' => 38,
                'name' => '戸松遥',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 22:07:40',
                'updated_at' => '2019-11-24 22:07:40',
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'artist_id' => 39,
                'name' => 'UNISON SQUARE GARDEN',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-11-24 22:10:02',
                'updated_at' => '2019-11-24 22:10:02',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}