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
                'setlist_id' => 1,
                'event_id' => 1,
                'artist_id' => 1,
                'created_at' => '2019-11-22 05:36:11',
                'updated_at' => '2019-11-22 05:36:11',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'setlist_id' => 2,
                'event_id' => 3,
                'artist_id' => 1,
                'created_at' => '2019-11-22 05:42:49',
                'updated_at' => '2019-11-22 05:42:49',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'setlist_id' => 3,
                'event_id' => 2,
                'artist_id' => 1,
                'created_at' => '2019-11-22 05:46:07',
                'updated_at' => '2019-11-22 05:46:07',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'setlist_id' => 4,
                'event_id' => 4,
                'artist_id' => 1,
                'created_at' => '2019-11-22 05:51:18',
                'updated_at' => '2019-11-22 05:51:18',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'setlist_id' => 5,
                'event_id' => 5,
                'artist_id' => 1,
                'created_at' => '2019-11-22 05:53:00',
                'updated_at' => '2019-11-22 05:53:00',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'setlist_id' => 6,
                'event_id' => 6,
                'artist_id' => 1,
                'created_at' => '2019-11-22 05:54:50',
                'updated_at' => '2019-11-22 05:54:50',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'setlist_id' => 7,
                'event_id' => 7,
                'artist_id' => 1,
                'created_at' => '2019-11-22 05:58:27',
                'updated_at' => '2019-11-22 05:58:27',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'setlist_id' => 8,
                'event_id' => 8,
                'artist_id' => 1,
                'created_at' => '2019-11-22 06:00:58',
                'updated_at' => '2019-11-22 06:00:58',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'setlist_id' => 9,
                'event_id' => 9,
                'artist_id' => 1,
                'created_at' => '2019-11-22 06:08:33',
                'updated_at' => '2019-11-22 06:08:33',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'setlist_id' => 10,
                'event_id' => 10,
                'artist_id' => 1,
                'created_at' => '2019-11-22 06:09:40',
                'updated_at' => '2019-11-22 06:09:40',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'setlist_id' => 11,
                'event_id' => 11,
                'artist_id' => 1,
                'created_at' => '2019-11-22 06:13:28',
                'updated_at' => '2019-11-22 06:13:28',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'setlist_id' => 12,
                'event_id' => 12,
                'artist_id' => 1,
                'created_at' => '2019-11-22 06:15:31',
                'updated_at' => '2019-11-22 06:15:31',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'setlist_id' => 13,
                'event_id' => 13,
                'artist_id' => 1,
                'created_at' => '2019-11-22 06:18:48',
                'updated_at' => '2019-11-22 06:18:48',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'setlist_id' => 14,
                'event_id' => 14,
                'artist_id' => 1,
                'created_at' => '2019-11-22 06:23:41',
                'updated_at' => '2019-11-22 06:23:41',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'setlist_id' => 15,
                'event_id' => 15,
                'artist_id' => 1,
                'created_at' => '2019-11-22 06:25:59',
                'updated_at' => '2019-11-22 06:25:59',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'setlist_id' => 16,
                'event_id' => 16,
                'artist_id' => 1,
                'created_at' => '2019-11-22 06:28:37',
                'updated_at' => '2019-11-22 06:28:37',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'setlist_id' => 17,
                'event_id' => 17,
                'artist_id' => 1,
                'created_at' => '2019-11-22 06:31:36',
                'updated_at' => '2019-11-22 06:31:36',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'setlist_id' => 18,
                'event_id' => 18,
                'artist_id' => 1,
                'created_at' => '2019-11-22 06:33:04',
                'updated_at' => '2019-11-22 06:33:04',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'setlist_id' => 19,
                'event_id' => 19,
                'artist_id' => 1,
                'created_at' => '2019-11-22 06:34:37',
                'updated_at' => '2019-11-22 06:34:37',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'setlist_id' => 20,
                'event_id' => 20,
                'artist_id' => 1,
                'created_at' => '2019-11-22 06:36:45',
                'updated_at' => '2019-11-22 06:36:45',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'setlist_id' => 21,
                'event_id' => 21,
                'artist_id' => 1,
                'created_at' => '2019-11-22 06:38:48',
                'updated_at' => '2019-11-22 06:38:48',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'setlist_id' => 22,
                'event_id' => 22,
                'artist_id' => 1,
                'created_at' => '2019-11-22 06:40:08',
                'updated_at' => '2019-11-22 06:40:08',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'setlist_id' => 23,
                'event_id' => 23,
                'artist_id' => 1,
                'created_at' => '2019-11-22 06:46:31',
                'updated_at' => '2019-11-22 06:46:31',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'setlist_id' => 24,
                'event_id' => 24,
                'artist_id' => 1,
                'created_at' => '2019-11-22 06:55:47',
                'updated_at' => '2019-11-22 06:55:47',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'setlist_id' => 25,
                'event_id' => 25,
                'artist_id' => 1,
                'created_at' => '2019-11-22 06:59:48',
                'updated_at' => '2019-11-22 06:59:48',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'setlist_id' => 26,
                'event_id' => 26,
                'artist_id' => 1,
                'created_at' => '2019-11-22 07:02:08',
                'updated_at' => '2019-11-22 07:02:08',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'setlist_id' => 27,
                'event_id' => 27,
                'artist_id' => 1,
                'created_at' => '2019-11-22 07:04:15',
                'updated_at' => '2019-11-22 07:04:15',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'setlist_id' => 28,
                'event_id' => 28,
                'artist_id' => 1,
                'created_at' => '2019-11-22 07:06:38',
                'updated_at' => '2019-11-22 07:06:38',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'setlist_id' => 29,
                'event_id' => 29,
                'artist_id' => 1,
                'created_at' => '2019-11-22 07:08:34',
                'updated_at' => '2019-11-22 07:08:34',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'setlist_id' => 30,
                'event_id' => 30,
                'artist_id' => 1,
                'created_at' => '2019-11-22 07:11:21',
                'updated_at' => '2019-11-22 07:11:21',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'setlist_id' => 31,
                'event_id' => 31,
                'artist_id' => 1,
                'created_at' => '2019-11-22 22:57:46',
                'updated_at' => '2019-11-22 22:57:46',
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'setlist_id' => 32,
                'event_id' => 32,
                'artist_id' => 1,
                'created_at' => '2019-11-22 23:01:33',
                'updated_at' => '2019-11-22 23:01:33',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'setlist_id' => 33,
                'event_id' => 33,
                'artist_id' => 1,
                'created_at' => '2019-11-22 23:06:26',
                'updated_at' => '2019-11-22 23:06:26',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'setlist_id' => 34,
                'event_id' => 34,
                'artist_id' => 1,
                'created_at' => '2019-11-22 23:09:31',
                'updated_at' => '2019-11-22 23:09:31',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'setlist_id' => 35,
                'event_id' => 35,
                'artist_id' => 1,
                'created_at' => '2019-11-22 23:12:28',
                'updated_at' => '2019-11-22 23:12:28',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'setlist_id' => 36,
                'event_id' => 36,
                'artist_id' => 1,
                'created_at' => '2019-11-22 23:15:51',
                'updated_at' => '2019-11-22 23:15:51',
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'setlist_id' => 37,
                'event_id' => 37,
                'artist_id' => 1,
                'created_at' => '2019-11-22 23:27:01',
                'updated_at' => '2019-11-22 23:27:01',
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'setlist_id' => 38,
                'event_id' => 38,
                'artist_id' => 1,
                'created_at' => '2019-11-22 23:29:52',
                'updated_at' => '2019-11-22 23:29:52',
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'setlist_id' => 39,
                'event_id' => 39,
                'artist_id' => 1,
                'created_at' => '2019-11-22 23:34:42',
                'updated_at' => '2019-11-22 23:34:42',
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'setlist_id' => 40,
                'event_id' => 40,
                'artist_id' => 1,
                'created_at' => '2019-11-22 23:38:45',
                'updated_at' => '2019-11-22 23:38:45',
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'setlist_id' => 41,
                'event_id' => 41,
                'artist_id' => 1,
                'created_at' => '2019-11-22 23:45:46',
                'updated_at' => '2019-11-22 23:45:46',
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'setlist_id' => 42,
                'event_id' => 42,
                'artist_id' => 1,
                'created_at' => '2019-11-22 23:50:39',
                'updated_at' => '2019-11-22 23:50:39',
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'setlist_id' => 43,
                'event_id' => 43,
                'artist_id' => 1,
                'created_at' => '2019-11-22 23:54:08',
                'updated_at' => '2019-11-22 23:54:08',
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'setlist_id' => 44,
                'event_id' => 44,
                'artist_id' => 1,
                'created_at' => '2019-11-22 23:55:39',
                'updated_at' => '2019-11-22 23:55:39',
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'setlist_id' => 45,
                'event_id' => 45,
                'artist_id' => 1,
                'created_at' => '2019-11-22 23:58:33',
                'updated_at' => '2019-11-22 23:58:33',
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'setlist_id' => 46,
                'event_id' => 46,
                'artist_id' => 1,
                'created_at' => '2019-11-23 00:00:11',
                'updated_at' => '2019-11-23 00:00:11',
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'setlist_id' => 47,
                'event_id' => 47,
                'artist_id' => 1,
                'created_at' => '2019-11-23 00:03:42',
                'updated_at' => '2019-11-23 00:03:42',
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'setlist_id' => 48,
                'event_id' => 48,
                'artist_id' => 1,
                'created_at' => '2019-11-23 00:05:41',
                'updated_at' => '2019-11-23 00:05:41',
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'setlist_id' => 49,
                'event_id' => 49,
                'artist_id' => 1,
                'created_at' => '2019-11-23 00:13:35',
                'updated_at' => '2019-11-23 00:13:35',
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'setlist_id' => 50,
                'event_id' => 50,
                'artist_id' => 1,
                'created_at' => '2019-11-23 00:16:00',
                'updated_at' => '2019-11-23 00:16:00',
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'setlist_id' => 51,
                'event_id' => 51,
                'artist_id' => 1,
                'created_at' => '2019-11-23 00:20:55',
                'updated_at' => '2019-11-23 00:20:55',
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'setlist_id' => 52,
                'event_id' => 52,
                'artist_id' => 1,
                'created_at' => '2019-11-23 00:33:58',
                'updated_at' => '2019-11-23 00:33:58',
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'setlist_id' => 53,
                'event_id' => 53,
                'artist_id' => 1,
                'created_at' => '2019-11-23 00:39:23',
                'updated_at' => '2019-11-23 00:39:23',
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'setlist_id' => 54,
                'event_id' => 54,
                'artist_id' => 1,
                'created_at' => '2019-11-23 13:47:25',
                'updated_at' => '2019-11-23 13:47:25',
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'setlist_id' => 55,
                'event_id' => 55,
                'artist_id' => 1,
                'created_at' => '2019-11-23 13:50:20',
                'updated_at' => '2019-11-23 13:50:20',
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'setlist_id' => 56,
                'event_id' => 56,
                'artist_id' => 1,
                'created_at' => '2019-11-23 13:55:13',
                'updated_at' => '2019-11-23 13:55:13',
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'setlist_id' => 57,
                'event_id' => 57,
                'artist_id' => 1,
                'created_at' => '2019-11-23 13:59:09',
                'updated_at' => '2019-11-23 13:59:09',
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'setlist_id' => 58,
                'event_id' => 58,
                'artist_id' => 1,
                'created_at' => '2019-11-23 14:03:40',
                'updated_at' => '2019-11-23 14:03:40',
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'setlist_id' => 59,
                'event_id' => 59,
                'artist_id' => 1,
                'created_at' => '2019-11-23 14:07:30',
                'updated_at' => '2019-11-23 14:07:30',
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'setlist_id' => 60,
                'event_id' => 60,
                'artist_id' => 1,
                'created_at' => '2019-11-23 14:09:46',
                'updated_at' => '2019-11-23 14:09:46',
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'setlist_id' => 61,
                'event_id' => 61,
                'artist_id' => 1,
                'created_at' => '2019-11-23 14:11:00',
                'updated_at' => '2019-11-23 14:11:00',
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'setlist_id' => 62,
                'event_id' => 62,
                'artist_id' => 1,
                'created_at' => '2019-11-23 14:19:26',
                'updated_at' => '2019-11-23 14:19:26',
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'setlist_id' => 63,
                'event_id' => 63,
                'artist_id' => 1,
                'created_at' => '2019-11-23 14:33:16',
                'updated_at' => '2019-11-23 14:33:16',
                'deleted_at' => NULL,
            ),
            63 => 
            array (
                'setlist_id' => 64,
                'event_id' => 64,
                'artist_id' => 1,
                'created_at' => '2019-11-23 14:49:56',
                'updated_at' => '2019-11-23 14:49:56',
                'deleted_at' => NULL,
            ),
            64 => 
            array (
                'setlist_id' => 65,
                'event_id' => 65,
                'artist_id' => 1,
                'created_at' => '2019-11-23 14:59:35',
                'updated_at' => '2019-11-23 14:59:35',
                'deleted_at' => NULL,
            ),
            65 => 
            array (
                'setlist_id' => 66,
                'event_id' => 66,
                'artist_id' => 1,
                'created_at' => '2019-11-23 15:04:49',
                'updated_at' => '2019-11-23 15:04:49',
                'deleted_at' => NULL,
            ),
            66 => 
            array (
                'setlist_id' => 67,
                'event_id' => 67,
                'artist_id' => 1,
                'created_at' => '2019-11-23 15:06:20',
                'updated_at' => '2019-11-23 15:06:20',
                'deleted_at' => NULL,
            ),
            67 => 
            array (
                'setlist_id' => 68,
                'event_id' => 68,
                'artist_id' => 1,
                'created_at' => '2019-11-23 15:16:10',
                'updated_at' => '2019-11-23 15:16:10',
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'setlist_id' => 69,
                'event_id' => 69,
                'artist_id' => 1,
                'created_at' => '2019-11-23 15:29:04',
                'updated_at' => '2019-11-23 15:29:04',
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'setlist_id' => 70,
                'event_id' => 70,
                'artist_id' => 1,
                'created_at' => '2019-11-24 02:37:23',
                'updated_at' => '2019-11-24 02:37:23',
                'deleted_at' => NULL,
            ),
            70 => 
            array (
                'setlist_id' => 71,
                'event_id' => 71,
                'artist_id' => 1,
                'created_at' => '2019-11-24 02:41:57',
                'updated_at' => '2019-11-24 02:41:57',
                'deleted_at' => NULL,
            ),
            71 => 
            array (
                'setlist_id' => 72,
                'event_id' => 72,
                'artist_id' => 1,
                'created_at' => '2019-11-24 02:52:42',
                'updated_at' => '2019-11-24 02:52:42',
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'setlist_id' => 73,
                'event_id' => 73,
                'artist_id' => 1,
                'created_at' => '2019-11-24 02:56:49',
                'updated_at' => '2019-11-24 02:56:49',
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'setlist_id' => 74,
                'event_id' => 74,
                'artist_id' => 1,
                'created_at' => '2019-11-24 02:59:20',
                'updated_at' => '2019-11-24 02:59:20',
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'setlist_id' => 75,
                'event_id' => 75,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:03:13',
                'updated_at' => '2019-11-24 03:03:13',
                'deleted_at' => NULL,
            ),
            75 => 
            array (
                'setlist_id' => 76,
                'event_id' => 76,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:05:38',
                'updated_at' => '2019-11-24 03:05:38',
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'setlist_id' => 77,
                'event_id' => 77,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:11:14',
                'updated_at' => '2019-11-24 03:11:14',
                'deleted_at' => NULL,
            ),
            77 => 
            array (
                'setlist_id' => 78,
                'event_id' => 78,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:13:47',
                'updated_at' => '2019-11-24 03:13:47',
                'deleted_at' => NULL,
            ),
            78 => 
            array (
                'setlist_id' => 79,
                'event_id' => 79,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:16:08',
                'updated_at' => '2019-11-24 03:16:08',
                'deleted_at' => NULL,
            ),
            79 => 
            array (
                'setlist_id' => 80,
                'event_id' => 80,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:19:19',
                'updated_at' => '2019-11-24 03:19:19',
                'deleted_at' => NULL,
            ),
            80 => 
            array (
                'setlist_id' => 81,
                'event_id' => 81,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:23:50',
                'updated_at' => '2019-11-24 03:23:50',
                'deleted_at' => NULL,
            ),
            81 => 
            array (
                'setlist_id' => 82,
                'event_id' => 82,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:30:14',
                'updated_at' => '2019-11-24 03:30:14',
                'deleted_at' => NULL,
            ),
            82 => 
            array (
                'setlist_id' => 83,
                'event_id' => 83,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:32:09',
                'updated_at' => '2019-11-24 03:32:09',
                'deleted_at' => NULL,
            ),
            83 => 
            array (
                'setlist_id' => 84,
                'event_id' => 84,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:34:18',
                'updated_at' => '2019-11-24 03:34:18',
                'deleted_at' => NULL,
            ),
            84 => 
            array (
                'setlist_id' => 85,
                'event_id' => 85,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:41:32',
                'updated_at' => '2019-11-24 03:41:32',
                'deleted_at' => NULL,
            ),
            85 => 
            array (
                'setlist_id' => 86,
                'event_id' => 86,
                'artist_id' => 1,
                'created_at' => '2019-11-24 12:21:19',
                'updated_at' => '2019-11-24 12:21:19',
                'deleted_at' => NULL,
            ),
            86 => 
            array (
                'setlist_id' => 87,
                'event_id' => 87,
                'artist_id' => 1,
                'created_at' => '2019-11-24 12:25:29',
                'updated_at' => '2019-11-24 12:25:29',
                'deleted_at' => NULL,
            ),
            87 => 
            array (
                'setlist_id' => 88,
                'event_id' => 88,
                'artist_id' => 1,
                'created_at' => '2019-11-24 12:31:08',
                'updated_at' => '2019-11-24 12:31:08',
                'deleted_at' => NULL,
            ),
            88 => 
            array (
                'setlist_id' => 89,
                'event_id' => 89,
                'artist_id' => 1,
                'created_at' => '2019-11-24 12:35:20',
                'updated_at' => '2019-11-24 12:35:20',
                'deleted_at' => NULL,
            ),
            89 => 
            array (
                'setlist_id' => 90,
                'event_id' => 90,
                'artist_id' => 1,
                'created_at' => '2019-11-24 13:28:17',
                'updated_at' => '2019-11-24 13:28:17',
                'deleted_at' => NULL,
            ),
            90 => 
            array (
                'setlist_id' => 91,
                'event_id' => 91,
                'artist_id' => 1,
                'created_at' => '2019-11-24 21:32:19',
                'updated_at' => '2019-11-24 21:32:19',
                'deleted_at' => NULL,
            ),
            91 => 
            array (
                'setlist_id' => 92,
                'event_id' => 92,
                'artist_id' => 1,
                'created_at' => '2019-11-24 21:35:30',
                'updated_at' => '2019-11-24 21:35:30',
                'deleted_at' => NULL,
            ),
            92 => 
            array (
                'setlist_id' => 93,
                'event_id' => 93,
                'artist_id' => 1,
                'created_at' => '2019-11-24 21:38:52',
                'updated_at' => '2019-11-24 21:38:52',
                'deleted_at' => NULL,
            ),
            93 => 
            array (
                'setlist_id' => 94,
                'event_id' => 94,
                'artist_id' => 1,
                'created_at' => '2019-11-24 21:42:27',
                'updated_at' => '2019-11-24 21:42:27',
                'deleted_at' => NULL,
            ),
            94 => 
            array (
                'setlist_id' => 95,
                'event_id' => 95,
                'artist_id' => 1,
                'created_at' => '2019-11-24 21:58:36',
                'updated_at' => '2019-11-24 21:58:36',
                'deleted_at' => NULL,
            ),
            95 => 
            array (
                'setlist_id' => 96,
                'event_id' => 96,
                'artist_id' => 1,
                'created_at' => '2019-11-24 22:01:19',
                'updated_at' => '2019-11-24 22:01:19',
                'deleted_at' => NULL,
            ),
            96 => 
            array (
                'setlist_id' => 97,
                'event_id' => 97,
                'artist_id' => 1,
                'created_at' => '2019-11-24 22:06:32',
                'updated_at' => '2019-11-24 22:06:32',
                'deleted_at' => NULL,
            ),
            97 => 
            array (
                'setlist_id' => 98,
                'event_id' => 98,
                'artist_id' => 1,
                'created_at' => '2019-11-24 22:15:33',
                'updated_at' => '2019-11-24 22:15:33',
                'deleted_at' => NULL,
            ),
            98 => 
            array (
                'setlist_id' => 99,
                'event_id' => 99,
                'artist_id' => 1,
                'created_at' => '2019-11-24 22:17:44',
                'updated_at' => '2019-11-24 22:17:44',
                'deleted_at' => NULL,
            ),
            99 => 
            array (
                'setlist_id' => 100,
                'event_id' => 100,
                'artist_id' => 1,
                'created_at' => '2019-11-24 22:19:40',
                'updated_at' => '2019-11-24 22:19:40',
                'deleted_at' => NULL,
            ),
            100 => 
            array (
                'setlist_id' => 101,
                'event_id' => 101,
                'artist_id' => 1,
                'created_at' => '2019-11-24 22:22:28',
                'updated_at' => '2019-11-24 22:22:28',
                'deleted_at' => NULL,
            ),
            101 => 
            array (
                'setlist_id' => 102,
                'event_id' => 102,
                'artist_id' => 1,
                'created_at' => '2019-11-24 22:24:14',
                'updated_at' => '2019-11-24 22:24:14',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}