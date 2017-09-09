<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
	protected $table = 'feedback';
	protected $fillable = ['name', 'email', 'text'];

}