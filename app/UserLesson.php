<?php

namespace App;
use DB;
use App\Message;

use Illuminate\Database\Eloquent\Model;

class UserLesson extends Model
{
	protected $table = 'user_lessons';
	protected $fillable = ['user_id', 'lesson_id', 'mark'];


	public static function getInstance($user_id, $lesson_id) {
		return self::where('user_id', $user_id)->where('lesson_id', $lesson_id)->first();
	}

	public function addHomework($filename, $comment) {
		DB::table('user_lesson_homeworks')->insert([
			'user_lesson_id' => $this->id,
			'file_path' => $filename,
			'comment' => $comment
			]);
	}

	public function files() {
		return DB::table('user_lesson_homeworks')->where('user_lesson_id', $this->id)->get();
	}

	public static function withLessonInfo($ids = null) {
		$query =  DB::table('user_lessons')
		->select('users.name as userName', 'lessons.name as lessonName', 'courses.name as courseName', 'user_lessons.*')
		->leftjoin('lessons', 'lessons.id', '=' , 'user_lessons.lesson_id')
		->leftjoin('users', 'users.id', '=' , 'user_lessons.user_id')
		->leftjoin('courses', 'courses.id', '=' , 'lessons.course_id');


		if($ids) {
			$query->whereIn('user_lessons.id', $ids);
		}


		$query->orderBy('id', 'desc');


		return $query->paginate(10);
	}

	public function getHomeworks() {
		return DB::table('user_lesson_homeworks')->where('user_lesson_id', $this->id)->get();
	}

	public function setCurrentToNext() {
		$lesson = DB::table('lessons')
		->select('lessons.position', 'lessons.course_id')
		->leftjoin('user_lessons', 'lessons.id', '=', 'user_lessons.lesson_id')
		->where('user_lessons.id', $this->id)
		->first();

		$currentPosition = DB::table('user_courses')
		->where('course_id', $lesson->course_id)
		->where('user_id', $this->user_id)
		->value('current_lesson_id');


		$maxPosition = DB::table('lessons')
		->where('course_id', $lesson->course_id)
		->max('position');


		if($lesson->position == $currentPosition && $currentPosition == $maxPosition) {
			DB::table('user_courses')
			->where('course_id', $lesson->course_id)
			->where('user_id', $this->user_id)
			->update(['complete' => 1]);
		}



		if($lesson->position == $currentPosition) {
			$currentPosition++;
			DB::table('user_courses')
			->where('course_id', $lesson->course_id)
			->where('user_id', $this->user_id)
			->update(['current_lesson_id' => $currentPosition]);
		}
	}

	public static function setMail($userLessons, $admin) {
		foreach ($userLessons as $userLesson) {
			$userLesson->mail = Message::current($userLesson->user_id, $userLesson->lesson_id)->isAdmin($admin)->notReaded()->count();
		}

		return $userLessons;
	}


	public function scopeConsultations($query, $userId) {
		$query->leftjoin('lessons', 'user_lessons.lesson_id', '=', 'lessons.id')
		->select('*', 'lessons.id as lessonId')
		->leftjoin('lesson_messages', function($q) use ($userId) {
			$q->on('lesson_messages.lesson_id', '=', 'lessons.id')
			->on('lesson_messages.created_at', '=', 
				DB::raw('(select max(created_at) from lesson_messages where lesson_messages.lesson_id = lessons.id)'))
			->where('user_lessons.user_id', '=' , $userId);
		})
		->where('user_lessons.user_id', $userId)
		->groupBy('user_lessons.id')
		->orderBy('lesson_messages.created_at', 'desc');
	}

	public function scopeCurrent($query, $userId, $lessonId) {
		$query->where('user_id', $userId)->where('lesson_id', $lessonId);
	}


	public function scopeUserCourse($query, $userId, $courseId) {
		$query->leftjoin('lessons', 'lessons.id', '=', 'user_lessons.lesson_id')
		->where('course_id', $courseId)
		->where('user_lessons.user_id', $userId);
	}

	public function getMark() {
		if($this->mark) {
			return $this->mark;
		}
	}

}