<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SetlistSong extends Model
{
	protected $fillable = [
		'setlist_id',
		'setlist_group_seq',
		'seq',
		'song_id',
	];
}
