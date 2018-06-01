<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInfo extends Model
{
	use SoftDeletes;

	protected $fillable = ['first_name', 'last_name', 'dni', 'address', 'phone', 'cell_phone'];

	protected $appends = ['fullName'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function getFullNameAttribute()
	{
		return "{$this->first_name} {$this->last_name}";
	}
}
