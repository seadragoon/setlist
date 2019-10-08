<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setlist extends Model
{
	protected $fillable = [
		'event_id',
		'artist_id',
	];
	protected $primaryKey = 'setlist_id';
}
