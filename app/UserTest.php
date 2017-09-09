<?php


namespace App;
use DB;


use Illuminate\Database\Eloquent\Model;

class UserTest extends Model {
	protected $table = 'user_tests';
	protected $fillable = ['user_id', 'test_id', 'current_position', 'complete', 'mark'];


	public function scopeCurrent($query, $user_id, $test_id) {
		return $query->where('user_id', $user_id)->where('test_id', $test_id);
	}


	public function scopeWithTestAndUser($query) {
		return $query->select('user_tests.*', 'tests.name as testName', 'users.name as userName')
		->leftjoin('tests', 'tests.id', '=', 'user_tests.test_id')
		->leftjoin('users', 'users.id', '=', 'user_tests.user_id');
	}


	public function scopeComplete($query) {
		return $query->where('user_tests.complete', 1);
	}

	public function scopeDesc($query) {
		return $query->orderBy('user_tests.created_at', 'desc');
	}

}