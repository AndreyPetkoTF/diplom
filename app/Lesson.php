<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
	protected $table = 'lessons';
	protected $fillable = ['name', 'text', 'video_link', 'home_text', 'course_id', 'position', 'more_info'];


	public function course() {
		return $this->belongsTo('App\User');
	}

	public function getMark($user_id) {
		$this->mark = DB::table('user_lessons')->where('lesson_id', $this->id)->where('user_id', $user_id)->value('mark');
	}


}