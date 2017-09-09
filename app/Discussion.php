<?php

namespace App;
use DB;
use App\DiscussionMessage;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
	protected $table = 'discussions';
	protected $fillable = ['course_id', 'lesson_id', 'title'];


	public static function getByFilter($get) {
		if(isset($get['lesson_id'])) {
			return self::where('lesson_id', (int)$get['lesson_id'])->orderBy('created_at', 'desc')->paginate(20);
		}

		if(isset($get['course_id'])) {
			return self::where('course_id', (int)$get['course_id'])->orderBy('created_at', 'desc')->paginate(20);
		}

		return self::orderBy('created_at', 'desc')->paginate(20);
	}

	public function scopeWithCourseAndLessonAndCountMessages($query) {
		$query->select(DB::raw('*, courses.name as courseName, lessons.name as lessonName, discussions.id as id, count(discussion_messages.id) as countMessages'))
		->leftjoin('courses', 'courses.id', '=', 'discussions.course_id')
		->leftjoin('lessons', 'lessons.id', '=', 'discussions.lesson_id')
		->leftjoin('discussion_messages', 'discussions.id', '=', 'discussion_messages.discussion_id')
		->groupBy('discussions.id');
	}


	public function scopeDesc($query) {
		$query->orderBy('discussions.created_at', 'desc');
	}


	public function deleteMessages() {
		DiscussionMessage::deleteByDiscussionId($this->id);
	}

}