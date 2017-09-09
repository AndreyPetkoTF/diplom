<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $table = 'lesson_messages';
	protected $fillable = ['user_id', 'lesson_id', 'message', 'admin'];



	public function scopeCurrent($query,$user_id, $lesson_id) {
		$query->where('user_id', $user_id)->where('lesson_id', $lesson_id);
	}

	public function scopeIsAdmin($query, $bool) {
		$query->where('admin', $bool);
	}

	public function scopeUserName($query) {
		$query->leftjoin('users', 'users.id', '=', 'lesson_messages.user_id');
	}

	public function scopeSetReaded($query) {
		$query->update(['readed' => 1]);
	}

	public function scopeNotReaded($query) {
		$query->where(['readed' => 0]);
	}

	public function scopeUser($query, $userId) {
		$query->where('user_id', $userId);
	}

	public function setOwls() {
		$this->message = preg_replace('/:sov(\d\d?):/', '<img src="/smiles/s\1.png">', $this->message);
	}

}