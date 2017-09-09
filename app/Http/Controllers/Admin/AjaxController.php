<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Http\Requests;

use Request;
use App\Answer;



class AjaxController extends Controller
{

	public function __construct() {
		$this->middleware('isAdmin');
		$this->request = Request::all();
		unset($this->request['_token']);
	}

	public function getAnswerDelete($answerId) {
		Answer::where('id', $answerId)->delete();
	}

}