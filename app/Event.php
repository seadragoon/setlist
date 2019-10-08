<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $fillable = [
		'datetime',
		'name',
		'venue_name',
	];
	protected $primaryKey = 'event_id';
}
