<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctors extends Authenticatable
{
	protected $guard = 'doctor';

	protected $fillable = [
		'email', 'password','first_name','middle_name','last_name','mobile_no','courses','evaluation','department_id',
	];

	protected $hidden = [
		'password', 'remember_token',
	];
    public $timestamps = false;
}
