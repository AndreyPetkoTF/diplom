<?php


namespace App;
use DB;


class DiscussionsRepository {
	protected $discussions;


	public function __construct($discussions) {
		$this->discussions = $discussions;
	}

	public function setCountAnswers() {
		foreach ($this->discussions as $discussion) {
			$messages = DB::table('discussion_messages')->where('discussion_id', $discussion->id)->count();
			$discussion->answers = $messages - 1;
		}

		return $this->discussions;
	}
}