<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;


use Session;
use App\User;
use App\Course;
use App\Feedback;

class AjaxController extends Controller
{
	public function getCurCourseDelete($id) {
		$courses = Session::get('courses');

		unset($courses[array_search($id,$courses)]);

		Session::put('courses', $courses);
		Session::save();

		return Course::totalPrice($courses);
	}


	public function getCurCourseAdd($id) {
		$courses = Session::get('courses');

		if($courses && array_search($id,$courses) !== false) {
			return 0;
		}

		$courses[] = $id;

		$course = Course::find($id);

		Session::put('courses', $courses);
		Session::save();

		return view('site.components.bid-item', compact('course'));

	}

	public function getCurrentTotal() {
		$courses = Session::get('courses');
		return Course::totalPrice($courses);
	}

	public function getCourseLessons($courseId) {
		$course = Course::find($courseId);
		if($course && $course->countLessons()) {
			return $course->getLessons();
		}
	}


	public function getChangeUserSlider() {
		User::find($_GET['userId'])->setSlider($_GET['checked']);
	}


	public function postFeedbackAdd() {
		Feedback::create(['email' => $_POST['email'], 'text' => $_POST['text']]);
		return 1;
	}
}