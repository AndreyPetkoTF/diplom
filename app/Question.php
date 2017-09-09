<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $table = 'test_questions';
	protected $fillable = ['text', 'position', 'test_id'];


	public function scopeCurrent($query, $test_id, $position) {
		return $query->where('test_id', $test_id)->where('position', $position);
	}

}