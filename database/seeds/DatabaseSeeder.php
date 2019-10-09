<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ArtistsTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(SetlistGroupsTableSeeder::class);
        $this->call(SetlistSongsTableSeeder::class);
        $this->call(SetlistsTableSeeder::class);
        $this->call(SongsTableSeeder::class);
    }
}
