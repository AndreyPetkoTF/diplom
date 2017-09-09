<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\User;
use Auth;
use Request;
use Redirect;
use App\Test;
use App\Question;
use App\UserTest;
use App\Answer;

class TestController extends Controller
{

	public function __construct() {
		$this->middleware('auth');
		$this->request = Request::all();
		unset($this->request['_token']);
	}


	public function getIndex($test_id) {
		$test = Test::find($test_id);
		$questionCount = $test->questionCount();

		return view('profile.test.testIndex', compact('test', 'questionCount'));
	}


	public function getQuestion($test_id) {
		$userTest = UserTest::current(Auth::id(), $test_id)->first();

		if(!$userTest) {
			$userTest = UserTest::create(['user_id' => Auth::id(), 'test_id' => $test_id, 'current_position' => 1]);
		}

		$position = $userTest->current_position;

		$test =  Test::find($test_id);

		if($userTest->current_position > $test->questionCount()) {
			$userTest->complete = 1;
			$userTest->save();
			return Redirect::to('/profile/test/' . $test_id . '/finish');
		}

		$question = Question::current($test_id, $position)->first();
		$answers = Answer::where('question_id', $question->id)->get();


		$testName = $test->name;


		return view('profile.test.question', compact('question', 'answers', 'position', 'testName'));
	}


	public function postQuestion($test_id) {
		$answer_id = $this->request['answer'];
		$cur_mark = Answer::where('id', $answer_id)->value('right');

		$userTest = UserTest::current(Auth::id(), $test_id)->first();

		if($cur_mark) {
			$userTest->increment('mark');
		}

		$userTest->increment('current_position');

		return Redirect::back();
	}


	public function getFinish($test_id) {
		$test = Test::find($test_id);

		$questionsCount = $test->questionCount();
		$testName = $test->name;

		$userTest = UserTest::current(Auth::id(), $test_id)->first();

		$lesson_id = $test->lesson_id;

		return view('profile.test.finish', compact('testName', 'userTest', 'questionsCount', 'lesson_id'));
	}


	public function getRestart($test_id) {
		UserTest::current(Auth::id(), $test_id)->delete();
		return Redirect::to('/profile/test/' . $test_id);
	}


}