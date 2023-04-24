<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
	use HasFactory;

	protected $fillable = [
		'name',
		'city',
		't_date',
		'kick_off',
		'route_name',
		'start',
		'end'
	];

	public function scoreboard()
	{
		return $this->hasMany(Scoreboard::class);
	}
}
