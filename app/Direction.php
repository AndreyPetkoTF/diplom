<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
	public $timestamps = false;
	protected $table = 'courses_directions';
	protected $fillable = ['name'];

}