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
                'edit_user_id' => 3,
                'created_at' => '2019-11-22 04:51:09',
                'updated_at' => '2020-06-28 20:34:18',
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
            39 => 
            array (
                'artist_id' => 40,
                'name' => 'nonoc',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-12-21 21:20:41',
                'updated_at' => '2019-12-21 21:20:41',
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'artist_id' => 41,
                'name' => 'BoA',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-12-25 03:23:26',
                'updated_at' => '2019-12-25 03:23:26',
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'artist_id' => 42,
                'name' => 'マライア・キャリー',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-12-25 03:27:11',
                'updated_at' => '2019-12-25 03:27:11',
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'artist_id' => 43,
                'name' => 'Official髭男dism',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2019-12-25 03:27:42',
                'updated_at' => '2019-12-25 03:27:42',
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'artist_id' => 44,
                'name' => '*ChocoLate Bomb!!',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2020-11-02 04:29:49',
                'updated_at' => '2020-11-02 04:29:49',
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'artist_id' => 45,
                'name' => '八王子P',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2020-11-02 04:30:48',
                'updated_at' => '2020-11-02 04:30:48',
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'artist_id' => 46,
                'name' => 'T.M.Revoluion/水樹奈々',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2020-11-02 04:34:54',
                'updated_at' => '2020-11-02 04:34:54',
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'artist_id' => 47,
                'name' => 'ワルキューレ',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2020-11-02 04:37:40',
                'updated_at' => '2020-11-02 04:37:40',
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'artist_id' => 48,
                'name' => 'YOASOBI',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2020-11-02 04:38:05',
                'updated_at' => '2020-11-02 04:38:05',
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'artist_id' => 49,
                'name' => '小林愛香',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2020-11-02 04:39:37',
                'updated_at' => '2020-11-02 04:39:37',
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'artist_id' => 50,
                'name' => '鈴木このみ',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2020-11-02 04:41:27',
                'updated_at' => '2020-11-02 04:41:27',
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'artist_id' => 51,
                'name' => '前川陽子',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2020-11-02 04:43:39',
                'updated_at' => '2020-11-02 04:43:39',
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'artist_id' => 52,
                'name' => '原田千栄',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2020-11-02 04:45:22',
                'updated_at' => '2020-11-02 04:45:22',
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'artist_id' => 53,
                'name' => '新田恵海',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2020-11-02 04:56:24',
                'updated_at' => '2020-11-02 04:56:24',
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'artist_id' => 54,
                'name' => 'MYTH&ROID',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2020-11-02 04:56:41',
                'updated_at' => '2020-11-02 04:56:41',
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'artist_id' => 55,
                'name' => '久保田利伸',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-01-31 23:16:30',
                'updated_at' => '2021-01-31 23:16:30',
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'artist_id' => 56,
                'name' => 'globe',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-01-31 23:17:16',
                'updated_at' => '2021-01-31 23:17:16',
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'artist_id' => 57,
                'name' => '広瀬香美',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-01-31 23:18:17',
                'updated_at' => '2021-01-31 23:18:17',
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'artist_id' => 58,
            'name' => 'メイリア(GARNiDELiA)',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-03-24 17:29:10',
                'updated_at' => '2021-03-24 17:29:10',
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'artist_id' => 59,
                'name' => '高橋 瞳',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-03-24 19:04:31',
                'updated_at' => '2021-03-24 19:04:31',
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'artist_id' => 60,
                'name' => 'CHiCO with HoneyWorks',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-03-24 19:17:01',
                'updated_at' => '2021-03-24 19:17:01',
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'artist_id' => 61,
                'name' => 'A応P',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-03-24 19:17:36',
                'updated_at' => '2021-03-24 19:17:36',
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'artist_id' => 62,
                'name' => 'MARiA',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-06-21 02:19:29',
                'updated_at' => '2021-06-21 02:19:51',
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'artist_id' => 63,
                'name' => 'JUDY AND MARY',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-06-21 02:38:04',
                'updated_at' => '2021-06-21 02:38:04',
                'deleted_at' => NULL,
            ),
            63 => 
            array (
                'artist_id' => 64,
                'name' => '草野華余子',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-06-21 02:38:33',
                'updated_at' => '2021-06-21 02:38:33',
                'deleted_at' => NULL,
            ),
            64 => 
            array (
                'artist_id' => 65,
                'name' => '増田有華',
                'link' => NULL,
                'edit_user_id' => 5,
                'created_at' => '2021-10-23 00:58:58',
                'updated_at' => '2021-10-23 00:58:58',
                'deleted_at' => NULL,
            ),
            65 => 
            array (
                'artist_id' => 66,
                'name' => '岩崎良美',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-10-23 23:40:03',
                'updated_at' => '2021-10-23 23:40:03',
                'deleted_at' => NULL,
            ),
            66 => 
            array (
                'artist_id' => 67,
                'name' => 'SMAP',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-10-23 23:42:52',
                'updated_at' => '2021-10-23 23:42:52',
                'deleted_at' => NULL,
            ),
            67 => 
            array (
                'artist_id' => 68,
                'name' => 'MAHO堂',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-11-26 14:45:39',
                'updated_at' => '2021-11-26 14:45:39',
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'artist_id' => 69,
                'name' => 'sajou no hana',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-11-26 14:49:07',
                'updated_at' => '2021-11-26 14:49:07',
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'artist_id' => 70,
                'name' => 'あらき',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-12-15 20:41:53',
                'updated_at' => '2021-12-15 20:41:53',
                'deleted_at' => NULL,
            ),
            70 => 
            array (
                'artist_id' => 71,
                'name' => 'ぐるたみん',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-12-15 20:42:13',
                'updated_at' => '2021-12-15 20:42:13',
                'deleted_at' => NULL,
            ),
            71 => 
            array (
                'artist_id' => 72,
                'name' => 'らっぷびと',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-12-15 20:42:45',
                'updated_at' => '2021-12-15 20:42:45',
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'artist_id' => 73,
            'name' => '＿＿(アンダーバー)',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-12-15 20:44:12',
                'updated_at' => '2021-12-15 20:44:12',
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'artist_id' => 74,
                'name' => '+α/あるふぁきゅん。',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-12-15 20:44:53',
                'updated_at' => '2021-12-15 20:44:53',
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'artist_id' => 75,
                'name' => 'ChouCho',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-12-15 20:45:25',
                'updated_at' => '2021-12-15 20:45:25',
                'deleted_at' => NULL,
            ),
            75 => 
            array (
                'artist_id' => 76,
            'name' => 'nano(ナノ)',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-12-15 20:46:37',
                'updated_at' => '2021-12-15 20:46:37',
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'artist_id' => 77,
                'name' => 'VALSHE',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-12-15 20:47:10',
                'updated_at' => '2021-12-15 20:47:10',
                'deleted_at' => NULL,
            ),
            77 => 
            array (
                'artist_id' => 78,
                'name' => 'ユリカ/花たん',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2021-12-15 20:47:35',
                'updated_at' => '2021-12-15 20:47:35',
                'deleted_at' => NULL,
            ),
            78 => 
            array (
                'artist_id' => 79,
                'name' => '川本真琴',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2022-05-22 00:30:48',
                'updated_at' => '2022-05-22 00:30:48',
                'deleted_at' => NULL,
            ),
            79 => 
            array (
                'artist_id' => 80,
                'name' => '日髙のり子',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2022-05-22 00:32:10',
                'updated_at' => '2022-05-22 00:32:10',
                'deleted_at' => NULL,
            ),
            80 => 
            array (
                'artist_id' => 81,
                'name' => 'evening cinema',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2022-07-08 13:37:57',
                'updated_at' => '2022-07-08 13:37:57',
                'deleted_at' => NULL,
            ),
            81 => 
            array (
                'artist_id' => 82,
                'name' => 'cinnamons × evening cinema',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2022-07-08 13:40:07',
                'updated_at' => '2022-07-08 13:40:07',
                'deleted_at' => NULL,
            ),
            82 => 
            array (
                'artist_id' => 83,
                'name' => 'その他',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2022-08-02 06:37:41',
                'updated_at' => '2022-08-02 06:37:41',
                'deleted_at' => NULL,
            ),
            83 => 
            array (
                'artist_id' => 84,
                'name' => 'AKINO from bless4',
                'link' => NULL,
                'edit_user_id' => 1,
                'created_at' => '2022-08-02 06:39:25',
                'updated_at' => '2022-08-02 06:39:25',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}