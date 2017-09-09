<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class DiscussionMessage extends Model
{
	protected $table = 'discussion_messages';
	protected $fillable = ['discussion_id', 'text', 'user_id'];

	public function scopeWithUser($query) {
		$query->select('discussion_messages.*', 'discussion_messages.id as messageId', 'users.logo', 'users.name')
		->leftjoin('users', 'users.id', '=' , 'discussion_messages.user_id');
	}

	public function scopeByDiscussionId($query, $id) {
		$query->where('discussion_id', $id);
	}

	public static function deleteByDiscussionId($id) {
		self::where('discussion_id', $id)->delete();
	}

	public function setOwls() {
		$this->text = preg_replace('/:sov(\d\d?):/', '<img src="/smiles/s\1.png">', $this->text);
	}

}