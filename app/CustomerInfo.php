<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerInfo extends Model
{
	use SoftDeletes; // Habilita borrado suave (borrado por software)

	protected $fillable = ['business_name', 'ruc', 'address', 'phone', 'cell_phone'];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}

