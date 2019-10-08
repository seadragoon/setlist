<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetlistSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setlist_songs', function (Blueprint $table) {
            $table->bigInteger('setlist_id');
            $table->bigInteger('setlist_group_seq');
            $table->bigInteger('seq');
            $table->bigInteger('song_id');
	        $table->boolean('is_medley')->default(false);
            $table->string('collabo_artist_ids');
            $table->integer('arrange_type');
            $table->integer('edit_user_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setlist_songs');
    }
}
