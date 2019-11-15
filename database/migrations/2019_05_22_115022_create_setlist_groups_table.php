<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetlistGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setlist_groups', function (Blueprint $table) {
            $table->bigInteger('setlist_id');
            $table->bigInteger('setlist_group_seq');
            $table->integer('setlist_group_type')->default(0);
            $table->timestamps();
            $table->softDeletes();
            
            // primaryキーの指定
            $table->unique(['setlist_id', 'setlist_group_seq']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setlist_groups');
    }
}
