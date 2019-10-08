<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SetlistGroup extends Model
{
	protected $fillable = [
		'setlist_id',
		'setlist_group_seq',
		'setlist_group_type',
	];
}
