<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Students extends Authenticatable
{
	protected $guard = 'student';

	protected $fillable = [
		'email', 'password','first_name','middle_name','last_name','mobile_no','birth_date','level','GPA','CGPA','done_hrs','rem_hrs','academic_year','department_id',
	];

	protected $hidden = [
		'password', 'remember_token',
	];
    public $timestamps = false;
}
