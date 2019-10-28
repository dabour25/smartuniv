<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Assistants extends Authenticatable
{
    protected $guard = 'assistant';

	protected $fillable = [
		'email', 'password','first_name','middle_name','last_name','mobile_no','courses','evaluation','department_id',
	];

	protected $hidden = [
		'password', 'remember_token',
	];
    public $timestamps = false;
}
