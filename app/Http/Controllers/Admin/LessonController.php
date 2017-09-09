<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Request;
use App\Course;
use App\Image;
use Redirect;
use App\Lesson;


class LessonController extends Controller
{
	public function __construct() {
		$this->middleware('isAdmin');
		$this->request = Request::all();
		unset($this->request['_token']);
	}




	public function getAdd($course_id) {
		return view('admin.lessons.lessonAdd');
	}


	public function postAdd($course_id) {
		$this->request['course_id'] = $course_id;
		Lesson::create($this->request);
		return Redirect::to('/admin/course/lessons/' . $course_id);
	}


	public function getEdit($lesson_id) {
		$lesson = Lesson::find($lesson_id);
		return view('admin.lessons.lessonEdit', compact('lesson'));
	}

	public function postEdit($lesson_id) {
		Lesson::find($lesson_id)->update($this->request);
		return Redirect::to('/admin/course/lessons/' . $this->request['course_id']);
	}

	public function postDelete() {
		Lesson::find($this->request['lesson_id'])->delete();
		return Redirect::back();
	}

}