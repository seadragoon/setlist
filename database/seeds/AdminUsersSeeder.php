<?php

use Illuminate\Database\Seeder;

class AdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        \DB::table('users')->insert(array (
            0 => 
            array (
                'twitter_id' => 1000,
                'screen_name' => 'admin',
                'name' => 'admin_user',
                'profile_image' => null,
                'remember_token' => Str::random(10),
                'created_at' => '2019-10-08 07:31:27',
                'updated_at' => '2019-10-08 07:31:27',
            ),
        ));
    }
}
