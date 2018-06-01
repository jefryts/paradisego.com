<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Event extends Model
{
	use SoftDeletes; // Habilita borrado suave (borrado por software)

	protected $fillable = ['name', 'description', 'place', 'date', 'time', 'state'];

	protected $hidden = ['date', 'time', 'created_at', 'updated_at', 'deleted_at'];

	protected $appends = ['month', 'day', 'dayName', 'hour'];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function getMonthAttribute()
	{
		setlocale(LC_TIME, "spanish");
		$month = strftime("%B", strtotime($this->date));

		if ($month !== 'mayo') {
			$month = substr($month, 0, 3);
		}
		return ucfirst($month);
	}

	public function getDayAttribute()
	{
		return date('d', strtotime($this->date));
	}

	public function getDayNameAttribute()
	{
		setlocale(LC_TIME, "spanish");
		return ucfirst(utf8_encode(strftime("%A", strtotime($this->date))));
	}

	public function getHourAttribute()
	{
		return date("h:i a", strtotime($this->time));
	}
}
