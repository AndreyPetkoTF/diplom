<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Http\Requests;

use Request;
use App\Course;
use App\Image;
use Redirect;
use App\Direction;


class CourseController extends Controller
{
	public function __construct() {
		$this->middleware('isAdmin');
		$this->request = Request::all();
		unset($this->request['_token']);
	}


	public function getIndex() {
		$courses = Course::getWithLessonsCount();
		return view('admin.courses.coursesList', compact('courses'));
	}


	public function getAdd() {
		$directions = Direction::all();
		return view('admin.courses.courseAdd', compact('directions'));
	}

	public function postAdd() {
		$image = new  Image(Request::file('logo'));
		if($image->hasFile()) {
			$image->toImageFolder('images');
			$this->request['logo'] = $image->getName();
		}

		$this->request['premium'] = isset($this->request['premium']) ? 1 : 0;

		Course::create($this->request);

		return Redirect::to('/admin/course');

	}



	public function getEdit($course_id) {
		$directions = Direction::all();
		$course = Course::find($course_id);
		return view('admin.courses.courseEdit', compact('course', 'directions'));
	}


	public function postEdit($course_id) {
		$course = Course::find($course_id);

		$image = new  Image(Request::file('logo'));
		if($image->hasFile()) {
			$image->toImageFolder('images');
			Image::deleteImage($course->logo, 'images');
			$this->request['logo'] = $image->getName();
		}

		$this->request['premium'] = isset($this->request['premium']) ? 1 : 0;

		$course->update($this->request);

		return Redirect::to('admin/course');

	}


	public function postDelete() {
		Course::find($this->request['course_id'])->delete();
		return Redirect::back();
	}


	public function getLessons($course_id) {
		$course = Course::find($course_id);
		return view('admin.lessons.lessonsList', compact('course'));
	}

	public function getDirections() {
		$directions = Direction::all();
		return view('admin.directions.directionsList', compact('directions'));
	}

	public function getDirectionAdd() {
		return view('admin.directions.directionAdd');
	}

	public function postDirectionAdd(Requests\DirectionRequest $request) {
		Direction::create($this->request);
		return Redirect::to('admin/course/directions');
	}

	public function getDirectionEdit($id) {
		$direction = Direction::find($id);
		return view('admin.directions.directionEdit', compact('direction'));
	}

	public function postDirectionEdit($id) {
		Direction::find($id)->update($this->request);
		return Redirect::to('admin/course/directions');
	}


	public function postDirectionDelete() {
		$id = $this->request['id'];
		Direction::find($id)->delete();
		return Redirect::back();
	}


}
