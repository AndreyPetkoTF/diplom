<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Keyval extends Model
{
	protected $table = 'keyval';
	protected $fillable = ['key', 'value'];


	public static function getByKey($key) {
		return self::where('key', $key)->value('value');
	}

	public static function updateByKey($key, $value) {
		self::where('key', $key)->update($value);
	}


}