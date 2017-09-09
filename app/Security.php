<?php namespace App;

use App\Lesson;
use DB;
use Auth;

class Security {
	public static function check($lessonId) {
		$courses = DB::table('user_courses')->where('user_id', Auth::id())->lists('course_id');
		$lesson = Lesson::whereIn('course_id', $courses)->lists('id');


		if(!in_array($lessonId, $lesson->toArray())) {
			return false;
		}


		return true;
	}
}