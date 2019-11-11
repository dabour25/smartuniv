<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Places extends Model
{
    public $timestamps = false;
    protected $fillable = [
		'name', 'capacity', 'type',
	];
}
