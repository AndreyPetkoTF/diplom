<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Review;

class Course extends Model
{
	protected $table = 'courses';
	protected $fillable = ['name', 'logo', 'description', 'price', 'premium', 'direction_id', 'url', 'fullDescription', 'program'];


	public function lessons() {
		return $this->hasMany('App\Lesson')->orderBy('position');
	}


	public static function getWithLessonsCount() {
		return DB::select('SELECT  courses.*, courses_directions.name as directionName, count(lessons.id) as lessonsCount FROM courses
			LEFT JOIN lessons ON lessons.course_id = courses.id
			LEFT JOIN courses_directions ON courses.direction_id = courses_directions.id
			GROUP BY courses.id');
	}

	public static function getTop($count, $notId = 0) {
		return self::orderBy('rate', 'desc')->where('id', '!=' , $notId)->take($count)->get();
	}

	public function scopeUrl($query, $url) {
		$query->where('url', $url);
	}


	public function getCourseRate() {
		$reviews = Review::courses($this->id)->get();

		if(!count($reviews)) {
			return 5;
		}

		$sum = 0;

		foreach($reviews as $review) {
			$sum += $review->stars;
		}

		return $sum / count($reviews);
	}



	public static function groupByDirection($directions) {
		foreach ($directions as $key => $direction) {
			$courses = self::where('direction_id', $direction->id)->get();
			if($courses) {
				$direction['courses'] = $courses;
			} else {
				unset($directions[$key]);
			}
		}

		return $directions;
	}

	public static function totalPrice($coursesIds) {
		return DB::table('courses')->whereIn('id', $coursesIds)->sum('price');
	}

	public static function getUserItems($user_id) {
		return DB::table('courses')
		->select(DB::raw('count(lessons.id) as lessons, courses.*, user_courses.current_lesson_id'))
		->leftjoin('user_courses', 'user_courses.course_id', '=', 'courses.id')
		->leftjoin('lessons', 'courses.id', '=', 'lessons.course_id')
		->where('user_courses.user_id', $user_id)
		->groupBy('courses.id')
		->get();
	}

	public static function getProgress($course, $user_id) {
		return (($course->current_lesson_id  - 1)/ $course->lessons) * 100;
	}

	public static function getOther($coursesId) {
		return DB::table('courses')->whereNotIn('id', $coursesId)->get();
	}

	public function currentLesson() {
		return DB::table('user_courses')->where('user_id', Auth::user()->id)->where('course_id', $this->id)->value('current_lesson_id');
	}

	public function getCourseProgress() {
		$this->progress = ($this->currentLesson() - 1) / $this->lessons->count() * 100;
	}

	public function getLessons() {
		return DB::table('lessons')->where('course_id', $this->id)->lists('name', 'id');
	}

	public function countLessons() {
		return DB::table('lessons')->where('course_id', $this->id)->count('id');
	}

	public static function getRealLessonId($userCourse) {
		return DB::table('lessons')->where('course_id', $userCourse->id)->where('position', $userCourse->current_lesson_id)->value('id');
	}

	public function getCourseComplete($userId) {
		$this->complete = DB::table('user_courses')->where('user_id', $userId)->where('course_id', $this->id)->value('complete');
	}



}