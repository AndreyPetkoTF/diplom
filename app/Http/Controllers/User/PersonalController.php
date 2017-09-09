<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\User;
use Auth;
use Request;
use Redirect;
use App\CourseRepository;
use App\Course;
use App\Image;

class PersonalController extends Controller
{

	public function __construct() {
		$this->middleware('auth');
		$this->request = Request::all();
		unset($this->request['_token']);
	}

	public function getIndex() {
		$user = User::find(Auth::id());

		$courseList = new CourseRepository( new Course );
		$courseList->setUserId($user->id);

		$courses = $courseList->filterByUserId()
		->getProgressAndLesson()
		->getComplete()
		->sortByComplete()
		->getFinalMark()
		->get();

		return view('profile.personal', compact('user', 'courses'));
	}

	public function postUpdate() {
		User::find(Auth::id())->update($this->request);
		return Redirect::back();
	}

	public function postChangeLogo() {

		if(empty($this->request)) {
			return Redirect::back()->with('largeFile', 1);
		}

		if(Request::hasFile('logo') && Request::file('logo')->isValid()) {
			$extension =  Request::file('logo')->getClientOriginalExtension();
			$filename = uniqid() . '.' . $extension;
			Request::file('logo')->move('user_logos', $filename);

			$user = User::find(Auth::id());
			Image::deleteImage($user->logo, 'user_logos');

			$user->update([ 'logo' => $filename ]);
		}

		return Redirect::back();
	}

}