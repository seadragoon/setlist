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
                'setlist_id' => 48,
                'event_id' => 48,
                'artist_id' => 1,
                'created_at' => '2019-11-23 00:05:41',
                'updated_at' => '2019-11-23 00:05:41',
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'setlist_id' => 49,
                'event_id' => 49,
                'artist_id' => 1,
                'created_at' => '2019-11-23 00:13:35',
                'updated_at' => '2019-11-23 00:13:35',
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'setlist_id' => 50,
                'event_id' => 50,
                'artist_id' => 1,
                'created_at' => '2019-11-23 00:16:00',
                'updated_at' => '2019-11-23 00:16:00',
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'setlist_id' => 51,
                'event_id' => 51,
                'artist_id' => 1,
                'created_at' => '2019-11-23 00:20:55',
                'updated_at' => '2019-11-23 00:20:55',
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'setlist_id' => 52,
                'event_id' => 52,
                'artist_id' => 1,
                'created_at' => '2019-11-23 00:33:58',
                'updated_at' => '2019-11-23 00:33:58',
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'setlist_id' => 53,
                'event_id' => 53,
                'artist_id' => 1,
                'created_at' => '2019-11-23 00:39:23',
                'updated_at' => '2019-11-23 00:39:23',
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'setlist_id' => 54,
                'event_id' => 54,
                'artist_id' => 1,
                'created_at' => '2019-11-23 13:47:25',
                'updated_at' => '2019-11-23 13:47:25',
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'setlist_id' => 55,
                'event_id' => 55,
                'artist_id' => 1,
                'created_at' => '2019-11-23 13:50:20',
                'updated_at' => '2019-11-23 13:50:20',
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'setlist_id' => 56,
                'event_id' => 56,
                'artist_id' => 1,
                'created_at' => '2019-11-23 13:55:13',
                'updated_at' => '2019-11-23 13:55:13',
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'setlist_id' => 57,
                'event_id' => 57,
                'artist_id' => 1,
                'created_at' => '2019-11-23 13:59:09',
                'updated_at' => '2019-11-23 13:59:09',
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'setlist_id' => 58,
                'event_id' => 58,
                'artist_id' => 1,
                'created_at' => '2019-11-23 14:03:40',
                'updated_at' => '2019-11-23 14:03:40',
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'setlist_id' => 59,
                'event_id' => 59,
                'artist_id' => 1,
                'created_at' => '2019-11-23 14:07:30',
                'updated_at' => '2019-11-23 14:07:30',
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'setlist_id' => 60,
                'event_id' => 60,
                'artist_id' => 1,
                'created_at' => '2019-11-23 14:09:46',
                'updated_at' => '2019-11-23 14:09:46',
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'setlist_id' => 61,
                'event_id' => 61,
                'artist_id' => 1,
                'created_at' => '2019-11-23 14:11:00',
                'updated_at' => '2019-11-23 14:11:00',
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'setlist_id' => 62,
                'event_id' => 62,
                'artist_id' => 1,
                'created_at' => '2019-11-23 14:19:26',
                'updated_at' => '2019-11-23 14:19:26',
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'setlist_id' => 63,
                'event_id' => 63,
                'artist_id' => 1,
                'created_at' => '2019-11-23 14:33:16',
                'updated_at' => '2019-11-23 14:33:16',
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'setlist_id' => 64,
                'event_id' => 64,
                'artist_id' => 1,
                'created_at' => '2019-11-23 14:49:56',
                'updated_at' => '2019-11-23 14:49:56',
                'deleted_at' => NULL,
            ),
            63 => 
            array (
                'setlist_id' => 65,
                'event_id' => 65,
                'artist_id' => 1,
                'created_at' => '2019-11-23 14:59:35',
                'updated_at' => '2019-11-23 14:59:35',
                'deleted_at' => NULL,
            ),
            64 => 
            array (
                'setlist_id' => 66,
                'event_id' => 66,
                'artist_id' => 1,
                'created_at' => '2019-11-23 15:04:49',
                'updated_at' => '2019-11-23 15:04:49',
                'deleted_at' => NULL,
            ),
            65 => 
            array (
                'setlist_id' => 67,
                'event_id' => 67,
                'artist_id' => 1,
                'created_at' => '2019-11-23 15:06:20',
                'updated_at' => '2019-11-23 15:06:20',
                'deleted_at' => NULL,
            ),
            66 => 
            array (
                'setlist_id' => 68,
                'event_id' => 68,
                'artist_id' => 1,
                'created_at' => '2019-11-23 15:16:10',
                'updated_at' => '2019-11-23 15:16:10',
                'deleted_at' => NULL,
            ),
            67 => 
            array (
                'setlist_id' => 69,
                'event_id' => 69,
                'artist_id' => 1,
                'created_at' => '2019-11-23 15:29:04',
                'updated_at' => '2019-11-23 15:29:04',
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'setlist_id' => 70,
                'event_id' => 70,
                'artist_id' => 1,
                'created_at' => '2019-11-24 02:37:23',
                'updated_at' => '2019-11-24 02:37:23',
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'setlist_id' => 71,
                'event_id' => 71,
                'artist_id' => 1,
                'created_at' => '2019-11-24 02:41:57',
                'updated_at' => '2019-11-24 02:41:57',
                'deleted_at' => NULL,
            ),
            70 => 
            array (
                'setlist_id' => 72,
                'event_id' => 72,
                'artist_id' => 1,
                'created_at' => '2019-11-24 02:52:42',
                'updated_at' => '2019-11-24 02:52:42',
                'deleted_at' => NULL,
            ),
            71 => 
            array (
                'setlist_id' => 73,
                'event_id' => 73,
                'artist_id' => 1,
                'created_at' => '2019-11-24 02:56:49',
                'updated_at' => '2019-11-24 02:56:49',
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'setlist_id' => 74,
                'event_id' => 74,
                'artist_id' => 1,
                'created_at' => '2019-11-24 02:59:20',
                'updated_at' => '2019-11-24 02:59:20',
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'setlist_id' => 75,
                'event_id' => 75,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:03:13',
                'updated_at' => '2019-11-24 03:03:13',
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'setlist_id' => 76,
                'event_id' => 76,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:05:38',
                'updated_at' => '2019-11-24 03:05:38',
                'deleted_at' => NULL,
            ),
            75 => 
            array (
                'setlist_id' => 77,
                'event_id' => 77,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:11:14',
                'updated_at' => '2019-11-24 03:11:14',
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'setlist_id' => 78,
                'event_id' => 78,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:13:47',
                'updated_at' => '2019-11-24 03:13:47',
                'deleted_at' => NULL,
            ),
            77 => 
            array (
                'setlist_id' => 79,
                'event_id' => 79,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:16:08',
                'updated_at' => '2019-11-24 03:16:08',
                'deleted_at' => NULL,
            ),
            78 => 
            array (
                'setlist_id' => 80,
                'event_id' => 80,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:19:19',
                'updated_at' => '2019-11-24 03:19:19',
                'deleted_at' => NULL,
            ),
            79 => 
            array (
                'setlist_id' => 81,
                'event_id' => 81,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:23:50',
                'updated_at' => '2019-11-24 03:23:50',
                'deleted_at' => NULL,
            ),
            80 => 
            array (
                'setlist_id' => 82,
                'event_id' => 82,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:30:14',
                'updated_at' => '2019-11-24 03:30:14',
                'deleted_at' => NULL,
            ),
            81 => 
            array (
                'setlist_id' => 83,
                'event_id' => 83,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:32:09',
                'updated_at' => '2019-11-24 03:32:09',
                'deleted_at' => NULL,
            ),
            82 => 
            array (
                'setlist_id' => 84,
                'event_id' => 84,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:34:18',
                'updated_at' => '2019-11-24 03:34:18',
                'deleted_at' => NULL,
            ),
            83 => 
            array (
                'setlist_id' => 85,
                'event_id' => 85,
                'artist_id' => 1,
                'created_at' => '2019-11-24 03:41:32',
                'updated_at' => '2019-11-24 03:41:32',
                'deleted_at' => NULL,
            ),
            84 => 
            array (
                'setlist_id' => 86,
                'event_id' => 86,
                'artist_id' => 1,
                'created_at' => '2019-11-24 12:21:19',
                'updated_at' => '2019-11-24 12:21:19',
                'deleted_at' => NULL,
            ),
            85 => 
            array (
                'setlist_id' => 87,
                'event_id' => 87,
                'artist_id' => 1,
                'created_at' => '2019-11-24 12:25:29',
                'updated_at' => '2019-11-24 12:25:29',
                'deleted_at' => NULL,
            ),
            86 => 
            array (
                'setlist_id' => 88,
                'event_id' => 88,
                'artist_id' => 1,
                'created_at' => '2019-11-24 12:31:08',
                'updated_at' => '2019-11-24 12:31:08',
                'deleted_at' => NULL,
            ),
            87 => 
            array (
                'setlist_id' => 89,
                'event_id' => 89,
                'artist_id' => 1,
                'created_at' => '2019-11-24 12:35:20',
                'updated_at' => '2019-11-24 12:35:20',
                'deleted_at' => NULL,
            ),
            88 => 
            array (
                'setlist_id' => 90,
                'event_id' => 90,
                'artist_id' => 1,
                'created_at' => '2019-11-24 13:28:17',
                'updated_at' => '2019-11-24 13:28:17',
                'deleted_at' => NULL,
            ),
            89 => 
            array (
                'setlist_id' => 91,
                'event_id' => 91,
                'artist_id' => 1,
                'created_at' => '2019-11-24 21:32:19',
                'updated_at' => '2019-11-24 21:32:19',
                'deleted_at' => NULL,
            ),
            90 => 
            array (
                'setlist_id' => 92,
                'event_id' => 92,
                'artist_id' => 1,
                'created_at' => '2019-11-24 21:35:30',
                'updated_at' => '2019-11-24 21:35:30',
                'deleted_at' => NULL,
            ),
            91 => 
            array (
                'setlist_id' => 93,
                'event_id' => 93,
                'artist_id' => 1,
                'created_at' => '2019-11-24 21:38:52',
                'updated_at' => '2019-11-24 21:38:52',
                'deleted_at' => NULL,
            ),
            92 => 
            array (
                'setlist_id' => 94,
                'event_id' => 94,
                'artist_id' => 1,
                'created_at' => '2019-11-24 21:42:27',
                'updated_at' => '2019-11-24 21:42:27',
                'deleted_at' => NULL,
            ),
            93 => 
            array (
                'setlist_id' => 95,
                'event_id' => 95,
                'artist_id' => 1,
                'created_at' => '2019-11-24 21:58:36',
                'updated_at' => '2019-11-24 21:58:36',
                'deleted_at' => NULL,
            ),
            94 => 
            array (
                'setlist_id' => 96,
                'event_id' => 96,
                'artist_id' => 1,
                'created_at' => '2019-11-24 22:01:19',
                'updated_at' => '2019-11-24 22:01:19',
                'deleted_at' => NULL,
            ),
            95 => 
            array (
                'setlist_id' => 97,
                'event_id' => 97,
                'artist_id' => 1,
                'created_at' => '2019-11-24 22:06:32',
                'updated_at' => '2019-11-24 22:06:32',
                'deleted_at' => NULL,
            ),
            96 => 
            array (
                'setlist_id' => 98,
                'event_id' => 98,
                'artist_id' => 1,
                'created_at' => '2019-11-24 22:15:33',
                'updated_at' => '2019-11-24 22:15:33',
                'deleted_at' => NULL,
            ),
            97 => 
            array (
                'setlist_id' => 99,
                'event_id' => 99,
                'artist_id' => 1,
                'created_at' => '2019-11-24 22:17:44',
                'updated_at' => '2019-11-24 22:17:44',
                'deleted_at' => NULL,
            ),
            98 => 
            array (
                'setlist_id' => 100,
                'event_id' => 100,
                'artist_id' => 1,
                'created_at' => '2019-11-24 22:19:40',
                'updated_at' => '2019-11-24 22:19:40',
                'deleted_at' => NULL,
            ),
            99 => 
            array (
                'setlist_id' => 101,
                'event_id' => 101,
                'artist_id' => 1,
                'created_at' => '2019-11-24 22:22:28',
                'updated_at' => '2019-11-24 22:22:28',
                'deleted_at' => NULL,
            ),
            100 => 
            array (
                'setlist_id' => 102,
                'event_id' => 102,
                'artist_id' => 1,
                'created_at' => '2019-11-24 22:24:14',
                'updated_at' => '2019-11-24 22:24:14',
                'deleted_at' => NULL,
            ),
            101 => 
            array (
                'setlist_id' => 103,
                'event_id' => 103,
                'artist_id' => 1,
                'created_at' => '2019-11-25 01:29:46',
                'updated_at' => '2019-11-25 01:29:46',
                'deleted_at' => NULL,
            ),
            102 => 
            array (
                'setlist_id' => 104,
                'event_id' => 104,
                'artist_id' => 1,
                'created_at' => '2019-11-25 01:40:14',
                'updated_at' => '2019-11-25 01:40:14',
                'deleted_at' => NULL,
            ),
            103 => 
            array (
                'setlist_id' => 105,
                'event_id' => 105,
                'artist_id' => 1,
                'created_at' => '2019-11-25 02:03:30',
                'updated_at' => '2019-11-25 02:03:30',
                'deleted_at' => NULL,
            ),
            104 => 
            array (
                'setlist_id' => 106,
                'event_id' => 106,
                'artist_id' => 1,
                'created_at' => '2019-11-25 02:09:01',
                'updated_at' => '2019-11-25 02:09:01',
                'deleted_at' => NULL,
            ),
            105 => 
            array (
                'setlist_id' => 107,
                'event_id' => 107,
                'artist_id' => 1,
                'created_at' => '2019-11-25 02:10:08',
                'updated_at' => '2019-11-25 02:10:08',
                'deleted_at' => NULL,
            ),
            106 => 
            array (
                'setlist_id' => 108,
                'event_id' => 108,
                'artist_id' => 1,
                'created_at' => '2019-11-25 02:23:31',
                'updated_at' => '2019-11-25 02:23:31',
                'deleted_at' => NULL,
            ),
            107 => 
            array (
                'setlist_id' => 109,
                'event_id' => 109,
                'artist_id' => 1,
                'created_at' => '2019-11-25 02:37:54',
                'updated_at' => '2019-11-25 02:37:54',
                'deleted_at' => NULL,
            ),
            108 => 
            array (
                'setlist_id' => 110,
                'event_id' => 126,
                'artist_id' => 1,
                'created_at' => '2019-12-04 23:43:33',
                'updated_at' => '2019-12-04 23:43:33',
                'deleted_at' => NULL,
            ),
            109 => 
            array (
                'setlist_id' => 111,
                'event_id' => 127,
                'artist_id' => 40,
                'created_at' => '2019-12-21 21:28:35',
                'updated_at' => '2019-12-21 21:28:35',
                'deleted_at' => NULL,
            ),
            110 => 
            array (
                'setlist_id' => 112,
                'event_id' => 128,
                'artist_id' => 1,
                'created_at' => '2019-12-25 03:23:53',
                'updated_at' => '2019-12-25 03:23:53',
                'deleted_at' => NULL,
            ),
            111 => 
            array (
                'setlist_id' => 113,
                'event_id' => 129,
                'artist_id' => 1,
                'created_at' => '2019-12-25 03:28:59',
                'updated_at' => '2019-12-25 03:28:59',
                'deleted_at' => NULL,
            ),
            112 => 
            array (
                'setlist_id' => 114,
                'event_id' => 130,
                'artist_id' => 1,
                'created_at' => '2020-01-06 00:03:06',
                'updated_at' => '2020-01-06 00:03:06',
                'deleted_at' => NULL,
            ),
            113 => 
            array (
                'setlist_id' => 116,
                'event_id' => 133,
                'artist_id' => 1,
                'created_at' => '2020-01-30 23:06:31',
                'updated_at' => '2020-01-30 23:06:31',
                'deleted_at' => NULL,
            ),
            114 => 
            array (
                'setlist_id' => 117,
                'event_id' => 135,
                'artist_id' => 1,
                'created_at' => '2020-02-22 00:09:50',
                'updated_at' => '2020-02-22 00:09:50',
                'deleted_at' => NULL,
            ),
            115 => 
            array (
                'setlist_id' => 118,
                'event_id' => 136,
                'artist_id' => 1,
                'created_at' => '2020-02-26 22:43:54',
                'updated_at' => '2020-02-26 22:43:54',
                'deleted_at' => NULL,
            ),
            116 => 
            array (
                'setlist_id' => 119,
                'event_id' => 137,
                'artist_id' => 1,
                'created_at' => '2020-03-25 22:11:36',
                'updated_at' => '2020-03-25 22:11:36',
                'deleted_at' => NULL,
            ),
            117 => 
            array (
                'setlist_id' => 121,
                'event_id' => 138,
                'artist_id' => 1,
                'created_at' => '2020-06-29 13:24:45',
                'updated_at' => '2020-06-29 13:24:45',
                'deleted_at' => NULL,
            ),
            118 => 
            array (
                'setlist_id' => 122,
                'event_id' => 139,
                'artist_id' => 1,
                'created_at' => '2020-08-30 07:49:53',
                'updated_at' => '2020-08-30 07:49:53',
                'deleted_at' => NULL,
            ),
            119 => 
            array (
                'setlist_id' => 123,
                'event_id' => 140,
                'artist_id' => 1,
                'created_at' => '2020-08-30 23:11:32',
                'updated_at' => '2020-08-30 23:11:32',
                'deleted_at' => NULL,
            ),
            120 => 
            array (
                'setlist_id' => 124,
                'event_id' => 141,
                'artist_id' => 1,
                'created_at' => '2020-09-14 02:19:23',
                'updated_at' => '2020-09-14 02:19:23',
                'deleted_at' => NULL,
            ),
            121 => 
            array (
                'setlist_id' => 125,
                'event_id' => 142,
                'artist_id' => 1,
                'created_at' => '2020-09-14 02:21:50',
                'updated_at' => '2020-09-14 02:21:50',
                'deleted_at' => NULL,
            ),
            122 => 
            array (
                'setlist_id' => 126,
                'event_id' => 143,
                'artist_id' => 1,
                'created_at' => '2020-09-14 02:25:12',
                'updated_at' => '2020-09-14 02:25:12',
                'deleted_at' => NULL,
            ),
            123 => 
            array (
                'setlist_id' => 127,
                'event_id' => 144,
                'artist_id' => 1,
                'created_at' => '2020-11-02 04:52:54',
                'updated_at' => '2020-11-02 04:52:54',
                'deleted_at' => NULL,
            ),
            124 => 
            array (
                'setlist_id' => 128,
                'event_id' => 145,
                'artist_id' => 1,
                'created_at' => '2020-11-02 04:55:54',
                'updated_at' => '2020-11-02 04:55:54',
                'deleted_at' => NULL,
            ),
            125 => 
            array (
                'setlist_id' => 129,
                'event_id' => 146,
                'artist_id' => 1,
                'created_at' => '2020-11-30 01:49:34',
                'updated_at' => '2020-11-30 01:49:34',
                'deleted_at' => NULL,
            ),
            126 => 
            array (
                'setlist_id' => 130,
                'event_id' => 147,
                'artist_id' => 1,
                'created_at' => '2020-11-30 01:53:08',
                'updated_at' => '2020-11-30 01:53:08',
                'deleted_at' => NULL,
            ),
            127 => 
            array (
                'setlist_id' => 131,
                'event_id' => 148,
                'artist_id' => 1,
                'created_at' => '2021-02-01 00:29:38',
                'updated_at' => '2021-02-01 00:29:38',
                'deleted_at' => NULL,
            ),
            128 => 
            array (
                'setlist_id' => 132,
                'event_id' => 149,
                'artist_id' => 1,
                'created_at' => '2021-02-01 00:39:59',
                'updated_at' => '2021-02-01 00:39:59',
                'deleted_at' => NULL,
            ),
            129 => 
            array (
                'setlist_id' => 133,
                'event_id' => 150,
                'artist_id' => 1,
                'created_at' => '2021-03-01 00:51:52',
                'updated_at' => '2021-03-01 00:51:52',
                'deleted_at' => NULL,
            ),
            130 => 
            array (
                'setlist_id' => 134,
                'event_id' => 151,
                'artist_id' => 1,
                'created_at' => '2021-03-01 01:53:44',
                'updated_at' => '2021-03-01 01:53:44',
                'deleted_at' => NULL,
            ),
            131 => 
            array (
                'setlist_id' => 135,
                'event_id' => 152,
                'artist_id' => 1,
                'created_at' => '2021-03-22 01:46:54',
                'updated_at' => '2021-03-22 01:46:54',
                'deleted_at' => NULL,
            ),
            132 => 
            array (
                'setlist_id' => 136,
                'event_id' => 153,
                'artist_id' => 1,
                'created_at' => '2021-03-22 01:48:02',
                'updated_at' => '2021-03-22 01:48:02',
                'deleted_at' => NULL,
            ),
            133 => 
            array (
                'setlist_id' => 137,
                'event_id' => 154,
                'artist_id' => 1,
                'created_at' => '2021-03-22 01:51:52',
                'updated_at' => '2021-03-22 01:51:52',
                'deleted_at' => NULL,
            ),
            134 => 
            array (
                'setlist_id' => 138,
                'event_id' => 155,
                'artist_id' => 1,
                'created_at' => '2021-03-22 01:53:07',
                'updated_at' => '2021-03-22 01:53:07',
                'deleted_at' => NULL,
            ),
            135 => 
            array (
                'setlist_id' => 139,
                'event_id' => 156,
                'artist_id' => 1,
                'created_at' => '2021-03-24 15:46:10',
                'updated_at' => '2021-03-24 15:46:10',
                'deleted_at' => NULL,
            ),
            136 => 
            array (
                'setlist_id' => 140,
                'event_id' => 157,
                'artist_id' => 1,
                'created_at' => '2021-03-24 16:35:26',
                'updated_at' => '2021-03-24 16:35:26',
                'deleted_at' => NULL,
            ),
            137 => 
            array (
                'setlist_id' => 141,
                'event_id' => 158,
                'artist_id' => 1,
                'created_at' => '2021-03-24 16:37:19',
                'updated_at' => '2021-03-24 16:37:19',
                'deleted_at' => NULL,
            ),
            138 => 
            array (
                'setlist_id' => 142,
                'event_id' => 159,
                'artist_id' => 1,
                'created_at' => '2021-03-24 16:38:52',
                'updated_at' => '2021-03-24 16:38:52',
                'deleted_at' => NULL,
            ),
            139 => 
            array (
                'setlist_id' => 143,
                'event_id' => 160,
                'artist_id' => 1,
                'created_at' => '2021-03-24 16:43:18',
                'updated_at' => '2021-03-24 16:43:18',
                'deleted_at' => NULL,
            ),
            140 => 
            array (
                'setlist_id' => 144,
                'event_id' => 161,
                'artist_id' => 1,
                'created_at' => '2021-03-24 16:45:30',
                'updated_at' => '2021-03-24 16:45:30',
                'deleted_at' => NULL,
            ),
            141 => 
            array (
                'setlist_id' => 145,
                'event_id' => 162,
                'artist_id' => 1,
                'created_at' => '2021-03-24 16:48:27',
                'updated_at' => '2021-03-24 16:48:27',
                'deleted_at' => NULL,
            ),
            142 => 
            array (
                'setlist_id' => 146,
                'event_id' => 164,
                'artist_id' => 1,
                'created_at' => '2021-03-24 16:53:26',
                'updated_at' => '2021-03-24 16:53:26',
                'deleted_at' => NULL,
            ),
            143 => 
            array (
                'setlist_id' => 147,
                'event_id' => 165,
                'artist_id' => 1,
                'created_at' => '2021-03-24 16:55:17',
                'updated_at' => '2021-03-24 16:55:17',
                'deleted_at' => NULL,
            ),
            144 => 
            array (
                'setlist_id' => 148,
                'event_id' => 163,
                'artist_id' => 1,
                'created_at' => '2021-03-24 16:58:49',
                'updated_at' => '2021-03-24 16:58:49',
                'deleted_at' => NULL,
            ),
            145 => 
            array (
                'setlist_id' => 149,
                'event_id' => 168,
                'artist_id' => 1,
                'created_at' => '2021-03-24 17:31:12',
                'updated_at' => '2021-03-24 17:31:12',
                'deleted_at' => NULL,
            ),
            146 => 
            array (
                'setlist_id' => 150,
                'event_id' => 167,
                'artist_id' => 1,
                'created_at' => '2021-03-24 17:31:41',
                'updated_at' => '2021-03-24 17:31:41',
                'deleted_at' => NULL,
            ),
            147 => 
            array (
                'setlist_id' => 151,
                'event_id' => 169,
                'artist_id' => 1,
                'created_at' => '2021-03-24 17:37:06',
                'updated_at' => '2021-03-24 17:37:06',
                'deleted_at' => NULL,
            ),
            148 => 
            array (
                'setlist_id' => 152,
                'event_id' => 170,
                'artist_id' => 1,
                'created_at' => '2021-03-24 17:39:11',
                'updated_at' => '2021-03-24 17:39:11',
                'deleted_at' => NULL,
            ),
            149 => 
            array (
                'setlist_id' => 153,
                'event_id' => 171,
                'artist_id' => 1,
                'created_at' => '2021-03-24 17:41:55',
                'updated_at' => '2021-03-24 17:41:55',
                'deleted_at' => NULL,
            ),
            150 => 
            array (
                'setlist_id' => 154,
                'event_id' => 172,
                'artist_id' => 1,
                'created_at' => '2021-03-24 17:44:18',
                'updated_at' => '2021-03-24 17:44:18',
                'deleted_at' => NULL,
            ),
            151 => 
            array (
                'setlist_id' => 155,
                'event_id' => 173,
                'artist_id' => 1,
                'created_at' => '2021-03-24 17:46:01',
                'updated_at' => '2021-03-24 17:46:01',
                'deleted_at' => NULL,
            ),
            152 => 
            array (
                'setlist_id' => 156,
                'event_id' => 174,
                'artist_id' => 1,
                'created_at' => '2021-03-24 17:47:17',
                'updated_at' => '2021-03-24 17:47:17',
                'deleted_at' => NULL,
            ),
            153 => 
            array (
                'setlist_id' => 157,
                'event_id' => 175,
                'artist_id' => 1,
                'created_at' => '2021-03-24 17:51:28',
                'updated_at' => '2021-03-24 17:51:28',
                'deleted_at' => NULL,
            ),
            154 => 
            array (
                'setlist_id' => 158,
                'event_id' => 176,
                'artist_id' => 1,
                'created_at' => '2021-03-24 17:53:25',
                'updated_at' => '2021-03-24 17:53:25',
                'deleted_at' => NULL,
            ),
            155 => 
            array (
                'setlist_id' => 159,
                'event_id' => 177,
                'artist_id' => 1,
                'created_at' => '2021-03-24 17:55:48',
                'updated_at' => '2021-03-24 17:55:48',
                'deleted_at' => NULL,
            ),
            156 => 
            array (
                'setlist_id' => 160,
                'event_id' => 178,
                'artist_id' => 1,
                'created_at' => '2021-03-24 17:58:11',
                'updated_at' => '2021-03-24 17:58:11',
                'deleted_at' => NULL,
            ),
            157 => 
            array (
                'setlist_id' => 161,
                'event_id' => 179,
                'artist_id' => 1,
                'created_at' => '2021-03-24 17:59:29',
                'updated_at' => '2021-03-24 17:59:29',
                'deleted_at' => NULL,
            ),
            158 => 
            array (
                'setlist_id' => 162,
                'event_id' => 180,
                'artist_id' => 1,
                'created_at' => '2021-03-24 18:00:42',
                'updated_at' => '2021-03-24 18:00:42',
                'deleted_at' => NULL,
            ),
            159 => 
            array (
                'setlist_id' => 163,
                'event_id' => 181,
                'artist_id' => 1,
                'created_at' => '2021-03-24 18:02:26',
                'updated_at' => '2021-03-24 18:02:26',
                'deleted_at' => NULL,
            ),
            160 => 
            array (
                'setlist_id' => 164,
                'event_id' => 182,
                'artist_id' => 1,
                'created_at' => '2021-03-24 18:12:59',
                'updated_at' => '2021-03-24 18:12:59',
                'deleted_at' => NULL,
            ),
            161 => 
            array (
                'setlist_id' => 165,
                'event_id' => 183,
                'artist_id' => 1,
                'created_at' => '2021-03-24 18:38:40',
                'updated_at' => '2021-03-24 18:38:40',
                'deleted_at' => NULL,
            ),
            162 => 
            array (
                'setlist_id' => 166,
                'event_id' => 184,
                'artist_id' => 1,
                'created_at' => '2021-03-24 18:59:43',
                'updated_at' => '2021-03-24 18:59:43',
                'deleted_at' => NULL,
            ),
            163 => 
            array (
                'setlist_id' => 167,
                'event_id' => 185,
                'artist_id' => 1,
                'created_at' => '2021-03-24 19:02:59',
                'updated_at' => '2021-03-24 19:02:59',
                'deleted_at' => NULL,
            ),
            164 => 
            array (
                'setlist_id' => 168,
                'event_id' => 186,
                'artist_id' => 1,
                'created_at' => '2021-03-24 19:11:11',
                'updated_at' => '2021-03-24 19:11:11',
                'deleted_at' => NULL,
            ),
            165 => 
            array (
                'setlist_id' => 169,
                'event_id' => 187,
                'artist_id' => 1,
                'created_at' => '2021-03-24 19:15:32',
                'updated_at' => '2021-03-24 19:15:32',
                'deleted_at' => NULL,
            ),
            166 => 
            array (
                'setlist_id' => 170,
                'event_id' => 188,
                'artist_id' => 1,
                'created_at' => '2021-03-24 19:20:20',
                'updated_at' => '2021-03-24 19:20:20',
                'deleted_at' => NULL,
            ),
            167 => 
            array (
                'setlist_id' => 171,
                'event_id' => 189,
                'artist_id' => 1,
                'created_at' => '2021-03-24 19:21:03',
                'updated_at' => '2021-03-24 19:21:03',
                'deleted_at' => NULL,
            ),
            168 => 
            array (
                'setlist_id' => 172,
                'event_id' => 190,
                'artist_id' => 1,
                'created_at' => '2021-03-24 19:29:30',
                'updated_at' => '2021-03-24 19:29:30',
                'deleted_at' => NULL,
            ),
            169 => 
            array (
                'setlist_id' => 173,
                'event_id' => 192,
                'artist_id' => 1,
                'created_at' => '2021-03-24 19:46:27',
                'updated_at' => '2021-03-24 19:46:27',
                'deleted_at' => NULL,
            ),
            170 => 
            array (
                'setlist_id' => 174,
                'event_id' => 196,
                'artist_id' => 1,
                'created_at' => '2021-03-24 19:55:27',
                'updated_at' => '2021-03-24 19:55:27',
                'deleted_at' => NULL,
            ),
            171 => 
            array (
                'setlist_id' => 175,
                'event_id' => 197,
                'artist_id' => 1,
                'created_at' => '2021-03-24 20:00:39',
                'updated_at' => '2021-03-24 20:00:39',
                'deleted_at' => NULL,
            ),
            172 => 
            array (
                'setlist_id' => 176,
                'event_id' => 198,
                'artist_id' => 1,
                'created_at' => '2021-04-26 01:19:48',
                'updated_at' => '2021-04-26 01:19:48',
                'deleted_at' => NULL,
            ),
            173 => 
            array (
                'setlist_id' => 177,
                'event_id' => 199,
                'artist_id' => 62,
                'created_at' => '2021-06-21 02:42:28',
                'updated_at' => '2021-06-21 02:42:28',
                'deleted_at' => NULL,
            ),
            174 => 
            array (
                'setlist_id' => 178,
                'event_id' => 203,
                'artist_id' => 62,
                'created_at' => '2021-07-04 21:34:17',
                'updated_at' => '2021-07-04 21:34:17',
                'deleted_at' => NULL,
            ),
            175 => 
            array (
                'setlist_id' => 179,
                'event_id' => 200,
                'artist_id' => 62,
                'created_at' => '2021-07-04 21:35:04',
                'updated_at' => '2021-07-04 21:35:04',
                'deleted_at' => NULL,
            ),
            176 => 
            array (
                'setlist_id' => 180,
                'event_id' => 201,
                'artist_id' => 62,
                'created_at' => '2021-07-04 21:35:30',
                'updated_at' => '2021-07-04 21:35:30',
                'deleted_at' => NULL,
            ),
            177 => 
            array (
                'setlist_id' => 181,
                'event_id' => 202,
                'artist_id' => 62,
                'created_at' => '2021-07-04 21:35:55',
                'updated_at' => '2021-07-04 21:35:55',
                'deleted_at' => NULL,
            ),
            178 => 
            array (
                'setlist_id' => 182,
                'event_id' => 204,
                'artist_id' => 1,
                'created_at' => '2021-09-11 23:19:41',
                'updated_at' => '2021-09-11 23:19:41',
                'deleted_at' => NULL,
            ),
            179 => 
            array (
                'setlist_id' => 183,
                'event_id' => 206,
                'artist_id' => 1,
                'created_at' => '2021-10-23 23:44:12',
                'updated_at' => '2021-10-23 23:44:12',
                'deleted_at' => NULL,
            ),
            180 => 
            array (
                'setlist_id' => 184,
                'event_id' => 207,
                'artist_id' => 1,
                'created_at' => '2021-11-26 14:34:40',
                'updated_at' => '2021-11-26 14:34:40',
                'deleted_at' => NULL,
            ),
            181 => 
            array (
                'setlist_id' => 185,
                'event_id' => 205,
                'artist_id' => 1,
                'created_at' => '2021-11-26 14:48:19',
                'updated_at' => '2021-11-26 14:48:19',
                'deleted_at' => NULL,
            ),
            182 => 
            array (
                'setlist_id' => 186,
                'event_id' => 208,
                'artist_id' => 1,
                'created_at' => '2021-12-07 02:35:00',
                'updated_at' => '2021-12-07 02:35:00',
                'deleted_at' => NULL,
            ),
            183 => 
            array (
                'setlist_id' => 187,
                'event_id' => 209,
                'artist_id' => 62,
                'created_at' => '2021-12-15 20:52:32',
                'updated_at' => '2021-12-15 20:52:32',
                'deleted_at' => NULL,
            ),
            184 => 
            array (
                'setlist_id' => 188,
                'event_id' => 210,
                'artist_id' => 1,
                'created_at' => '2021-12-26 04:14:30',
                'updated_at' => '2021-12-26 04:14:30',
                'deleted_at' => NULL,
            ),
            185 => 
            array (
                'setlist_id' => 189,
                'event_id' => 212,
                'artist_id' => 1,
                'created_at' => '2022-01-11 08:28:40',
                'updated_at' => '2022-01-11 08:28:40',
                'deleted_at' => NULL,
            ),
            186 => 
            array (
                'setlist_id' => 190,
                'event_id' => 213,
                'artist_id' => 1,
                'created_at' => '2022-01-19 04:08:41',
                'updated_at' => '2022-01-19 04:08:41',
                'deleted_at' => NULL,
            ),
            187 => 
            array (
                'setlist_id' => 191,
                'event_id' => 214,
                'artist_id' => 1,
                'created_at' => '2022-01-19 04:12:07',
                'updated_at' => '2022-01-19 04:12:07',
                'deleted_at' => NULL,
            ),
            188 => 
            array (
                'setlist_id' => 192,
                'event_id' => 215,
                'artist_id' => 1,
                'created_at' => '2022-01-24 12:24:03',
                'updated_at' => '2022-01-24 12:24:03',
                'deleted_at' => NULL,
            ),
            189 => 
            array (
                'setlist_id' => 193,
                'event_id' => 216,
                'artist_id' => 1,
                'created_at' => '2022-05-22 00:27:54',
                'updated_at' => '2022-05-22 00:27:54',
                'deleted_at' => NULL,
            ),
            190 => 
            array (
                'setlist_id' => 194,
                'event_id' => 217,
                'artist_id' => 1,
                'created_at' => '2022-06-06 12:43:56',
                'updated_at' => '2022-06-06 12:43:56',
                'deleted_at' => NULL,
            ),
            191 => 
            array (
                'setlist_id' => 195,
                'event_id' => 218,
                'artist_id' => 62,
                'created_at' => '2022-06-22 23:54:54',
                'updated_at' => '2022-06-22 23:54:54',
                'deleted_at' => NULL,
            ),
            192 => 
            array (
                'setlist_id' => 196,
                'event_id' => 219,
                'artist_id' => 62,
                'created_at' => '2022-07-08 13:37:36',
                'updated_at' => '2022-07-08 13:37:36',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}