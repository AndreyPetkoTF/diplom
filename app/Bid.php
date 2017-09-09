<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
	protected $table = 'bids';
	protected $fillable = ['name', 'email'];


	public static function items() {
		return self::orderBy('id', 'desc')->paginate(10);
	}

}