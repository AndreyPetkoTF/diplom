<?php namespace App;

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;


class Review  extends Model {
	protected $table = 'course_review';
	protected $fillable = ['course_id', 'user_id', 'review', 'stars'];

	public function scopeCurrent($query, $userId, $courseId) {
		$query->where('user_id', $userId)->where('course_id', $courseId);
	}

	public function scopeWithUser($query) {
		$query->leftjoin('users', 'users.id', '=', 'course_review.user_id');
	}

	public function scopeWithCourse($query) {
		$query->leftjoin('courses', 'courses.id', '=', 'course_review.course_id');
	}


	public function scopeMySelect($query) {
		$query->select('course_review.*', 'courses.name as courseName', 'courses.url as url', 'users.name as userName');
	}

	public function scopeCourses($query, $course_id) {
		$query->where('course_id', $course_id);
	}

}