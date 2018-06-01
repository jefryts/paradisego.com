<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
	use SofDeletes;
	
	protected $fillable = ['code', 'type'];

	protected $guarded = ['qty', 'price'];
	
	public function event()
	{
		return $this->belongsTo(Event::class);
	}

	public function setCodeAttribute($value)
	{
		return $value . $this->event()->code . strtoupper(substr($this->type, 0, 3));
	}
}
