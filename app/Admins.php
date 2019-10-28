<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admins extends Authenticatable
{
    //protected $table='users';
	protected $guard = 'admin';

	protected $fillable = [
		'email', 'password',
	];

	protected $hidden = [
		'password', 'remember_token',
	];
}
