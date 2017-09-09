<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Request;
use Redirect;
use DB;
use App\User;
use App\Course;
use App\CourseRepository;
use App\UserLesson;

class UserController extends Controller
{
	public function __construct() {
		$this->middleware('isAdmin');
		$this->request = Request::all();
		unset($this->request['_token']);
	}



	public function getIndex() {
		$users = User::latest()->where('blocked', 0)->paginate(10);
		return view('admin.users.usersList', compact('users'));
	}

	public function getSingle($id) {
		$user = User::find($id);

		$courseRepository =  (new CourseRepository( new Course));
		$courseRepository->setUserId($user->id);

		$courses = $courseRepository->filterByUserId()->getProgressAndLesson()->get();

		return view('admin.users.usersSingle', compact('user', 'courses'));
	}

	public function getCourseHomework($userId, $courseId) {
		$userLessons = UserLesson::userCourse($userId, $courseId)->lists('user_lessons.id');

		$userLessons = UserLesson::withLessonInfo($userLessons);
		$userLessons = UserLesson::setMail($userLessons, 0);

		return view('admin.homework.homeList', compact('userLessons'));
	}


	public function getUsersCourseDelete($userId, $courseId) {
		$course = Course::find($courseId);
		User::find($userId)->courseDelete($course);
		return Redirect::back();
	}


	public function postDelete() {
		User::find($this->request['user_id'])->deleteUser();
		return Redirect::to('/admin/users');
	}


}