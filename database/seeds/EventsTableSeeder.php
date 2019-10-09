<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('events')->delete();
        
        \DB::table('events')->insert(array (
            0 => 
            array (
                'event_id' => 14,
                'datetime' => '2019-05-19 16:26:45',
            'name' => 'SACRA MUSIC FES.2019 -NEW GENERATION-(2日目)',
            'venue_name' => '幕張メッセ イベントホール (千葉県)',
                'summary' => NULL,
                'tag_text' => NULL,
                'event_type' => 0,
                'edit_user_id' => 0,
                'created_at' => '2019-05-28 16:26:45',
                'updated_at' => '2019-05-28 16:26:45',
            ),
            1 => 
            array (
                'event_id' => 15,
                'datetime' => '2019-05-18 17:22:51',
            'name' => 'SACRA MUSIC FES.2019 -NEW GENERATION-(1日目)',
            'venue_name' => '幕張メッセ イベントホール (千葉県)',
                'summary' => NULL,
                'tag_text' => NULL,
                'event_type' => 0,
                'edit_user_id' => 0,
                'created_at' => '2019-06-07 17:22:51',
                'updated_at' => '2019-06-07 17:22:51',
            ),
            2 => 
            array (
                'event_id' => 16,
                'datetime' => '2019-01-27 17:28:55',
                'name' => 'リスアニ!LIVE 2019',
            'venue_name' => '日本武道館 (東京都)',
                'summary' => NULL,
                'tag_text' => NULL,
                'event_type' => 0,
                'edit_user_id' => 0,
                'created_at' => '2019-06-07 17:28:55',
                'updated_at' => '2019-06-07 17:28:55',
            ),
            3 => 
            array (
                'event_id' => 17,
                'datetime' => '2018-08-24 16:00:00',
                'name' => 'Animelo Summer Live 2018 "OK!"',
            'venue_name' => 'さいたまスーパーアリーナ (埼玉県)',
                'summary' => NULL,
                'tag_text' => NULL,
                'event_type' => 0,
                'edit_user_id' => 0,
                'created_at' => '2019-06-13 19:41:44',
                'updated_at' => '2019-06-15 06:15:15',
            ),
        ));
        
        
    }
}