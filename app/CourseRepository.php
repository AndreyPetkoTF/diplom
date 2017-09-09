<?php


namespace App;
use DB;


class CourseRepository {
	protected $course;
	protected $courseList = [];
	protected $userId;


	public function __construct($course) {
		$this->course = $course;
	}

	public function setUserId($userId) {
		$this->userId = $userId;
	}


	public function filterByUserId() {
		foreach ($this->all() as $course) {
			$haveCourse = DB::table('user_courses')->where('user_id', $this->userId)->where('course_id', $course->id)->count('id');

			if($haveCourse) {
				$this->courseList[] = $course;
			}
		}

		return $this;
	}


	public function all() {
		return $this->course->all();
	}


	public function sortByRate() {
		$this->courseList = $this->all();

		foreach ($this->courseList as $course) {
			$course->rate = $course->getCourseRate();
		}

		$this->toArray();

		usort($this->courseList, function($a, $b){
			if ($a->rate == $b->ratae) {
				return 0;
			}
			return ($a->rate < $b->rate) ? 1 : -1;
		});



		return $this;
	}


	public function toArray() {
		$list = [];
		foreach ($this->courseList as $course) {
			$list[] = $course;
		}

		$this->courseList = $list;
	}


	public function getProgressAndLesson() {

		foreach ($this->courseList as $course) {
			$current_lesson_id = $this->getCurrentLessonId($course->id);
			$lessons = count($course->lessons);

			if($lessons) {
				$course->progress = ( ($current_lesson_id - 1) / $lessons ) * 100;
				$course->current_lesson_id = $current_lesson_id;
				$course->lesson_id = $this->getCurrentLessonId($course->id, $current_lesson_id);
			}

		}

		return $this;
	}

	public function get($count = null) {

		if($count) {
			$this->courseList = array_slice($this->courseList, 0, $count);
		}

		return $this->courseList;
	}


	public function getComplete() {
		foreach ($this->courseList as $courseListItem) {
			$courseListItem->complete = DB::table('user_courses')->where('user_id', $this->userId)->where('course_id', $courseListItem->id)->value('complete');
		}

		return $this;
	}

	public function sortByComplete() {
		usort($this->courseList, function($a, $b){
			if ($a->complete == $b->complete) {
				return 0;
			}
			return ($a->complete < $b->complete) ? -1 : 1;
		});

		return $this;
	}


	protected function getLessonRealId($courseId, $current_lesson_id) {
		return DB::table('lessons')->where('course_id', $courseId)->where('position', $current_lesson_id)->value('id');
	}


	public function getFinalMark() {
		foreach ($this->courseList as $course) {
			if($course->complete) {
				$lessons = count($course->lessons);

				$sum = DB::table('user_lessons')
				->where('user_id', $this->userId)
				->leftjoin('lessons', 'lessons.id', '=', 'user_lessons.lesson_id')
				->where('lessons.course_id', $course->id)
				->sum('user_lessons.mark');

				$course->finalMark = $sum / $lessons;
			}
		}

		return $this;
	}


	protected function getCurrentLessonId($courseId) {
		return DB::table('user_courses')->where('user_id', $this->userId)->where('course_id', $courseId)->value('current_lesson_id');
	}
}