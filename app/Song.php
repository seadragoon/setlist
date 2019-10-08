<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
	protected $fillable = [
		'artist_id',
		'name',
	];
	protected $primaryKey = 'song_id';
}
