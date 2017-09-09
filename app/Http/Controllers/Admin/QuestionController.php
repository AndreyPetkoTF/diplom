<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Request;
use App\Test;
use App\Lesson;
use Redirect;
use App\Question;



class QuestionController extends Controller
{
	public function __construct() {
		$this->middleware('isAdmin');
		$this->request = Request::all();
		unset($this->request['_token']);
	}

	public function getIndex($test_id) {
		$test = Test::find($test_id);
		$questions = Question::where('test_id', $test_id)->get();

		return view('admin.tests.questionsList', compact('test', 'questions'));
	}

	public function getAdd($test_id) {
		// die();
		return view('admin.tests.questionAdd');
	}


}
