<?php


namespace App;
use DB;
use App\Question;


class QuestionsRepository {
	protected $questions;
	protected $child;


	public function __construct($questions, $child) {
		$this->questions = $questions;
		$this->child = $child;
	}

	public function deleteItemsAnswers() {
		foreach ($this->questions as $question) {
			$this->child::where('question_id', $question->id)->delete();
		}
	}

	public function deleteItems() {
		foreach ($this->questions as $question) {
			Question::where('id', $question->id)->delete();
		}
	}
}