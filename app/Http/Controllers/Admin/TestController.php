<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Request;
use App\Test;
use App\Lesson;
use Redirect;
use App\Question;
use App\Answer;
use App\QuestionsRepository;
use App\UserTest;


class TestController extends Controller
{
	public function __construct() {
		$this->middleware('isAdmin');
		$this->request = Request::all();
		unset($this->request['_token']);
	}

	public function getIndex() {
		$tests = Test::withLesson()->get();
		return view('admin.tests.list', compact('tests'));
	}


	public function getEdit($test_id) {
		$test = Test::find($test_id);
		$lessons = Lesson::all();
		return view('admin.tests.edit', compact('test', 'lessons'));
	}

	public function postEdit($test_id) {
		$this->request['active'] = isset($this->request['active']) ? 1 : 0;
		Test::where('id', $test_id)->update($this->request);

		return Redirect::to('/admin/tests');
	}

	public function getAdd() {
		$lessons = Lesson::all();
		return view('admin.tests.add', compact('lessons'));
	}

	public function postAdd() {
		Test::create($this->request);
		return Redirect::to('admin/tests');
	}


	public function postDelete() {
		$test_id = $this->request['test_id'];

		$questions = Question::where('test_id', $test_id)->get();

		$repo = new QuestionsRepository($questions, new Answer());

		$repo->deleteItemsAnswers();
		$repo->deleteItems();

		Test::where('id', $test_id)->delete();

		return Redirect::back();
	}


	public function getQuestions($test_id) {
		$test = Test::find($test_id);
		$questions = Question::where('test_id', $test_id)->get();


		return view('admin.tests.questionsList', compact('questions', 'test'));
	}

	public function getQuestionAdd($test_id) {
		return view('admin.tests.questionAdd', compact('test_id'));
	}


	public function postQuestionAdd($test_id) {
		$answers = $this->request['answer'];

		$question_id = Question::create([
			'test_id' => $test_id,
			'position' => $this->request['position'],
			'text' => $this->request['text']
			])->id;

		foreach ($answers as $key => $answer) {
			$newAnswer = new Answer;
			$newAnswer->question_id = $question_id;
			$newAnswer->text = $answer;

			if($key == $this->request['right']) {
				$newAnswer->right = 1;
			}

			$newAnswer->save();
		}

		return Redirect::to('/admin/tests/questions/' . $test_id);
	}


	public function getQuestionEdit($question_id) {
		$question = Question::find($question_id);
		$answers = Answer::where('question_id', $question->id)->get();

		$rightId = Answer::where('question_id', $question->id)->where('right', 1)->value('id');

		return view('admin.tests.questionEdit', compact('question', 'answers', 'rightId'));
	}

	public function postQuestionEdit($question_id) {
		Question::where('id', $question_id)->update(['text' => $this->request['text'], 'position' => $this->request['position']]);

		if(isset($this->request['old_answer'])) {
			foreach ($this->request['old_answer'] as $id => $oldAnswer) {
				Answer::where('id', $id)->update(['text' => $oldAnswer]);
			}
		}

		Answer::where('question_id', $question_id)->update(['right' => 0]);

		if($this->request['rightId']) {
			Answer::where('id', $this->request['rightId'])->update(['right' => 1]);
		} else {
			$right = $this->request['right'];
		}

		if(isset($this->request['answer'])) {

			foreach ($this->request['answer'] as $key => $answer) {
				$newAnswer = new Answer;
				$newAnswer->question_id = $question_id;
				$newAnswer->text = $answer;

				if(isset($right) && $right == $key) {
					$newAnswer->right = 1;
				}

				$newAnswer->save();
			}
		}

		$test_id = Question::find($question_id)->test_id;

		return Redirect::to('/admin/tests/questions/' . $test_id);
	}


	public function postQuestionDelete() {
		$question_id = $this->request['question_id'];

		Answer::where('question_id', $question_id)->delete();
		Question::where('id', $question_id)->delete();
		return Redirect::back();
	}


	public function getUsers() {
		$userTests = UserTest::withTestAndUser()->complete()->desc()->paginate(10);

		return view('admin.tests.usersList', compact('userTests'));
	}




}
