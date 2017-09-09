<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Request;
use App\Course;
use App\Image;
use Redirect;
use App\News;
use App\Keyval;
use App\Pages;


class VariableController extends Controller
{
	public function __construct() {
		$this->middleware('isAdmin');
		$this->request = Request::all();
		unset($this->request['_token']);
	}

	public function getIndex() {
		$vars = Keyval::all();
		$pages = Pages::all();
		return view('admin.variables.varsList', compact('vars', 'pages'));
	}


	public function getEdit($key) {
		$varItem = Keyval::getByKey($key);
		return view('admin.variables.varEdit', compact('varItem', 'key'));
	}

	public function postEdit($key) {
		Keyval::updateByKey($key, $this->request);
		return Redirect::to('admin/variables');
	}

	public function getPageEdit($id) {
		$page = Pages::find($id);
		return view('admin.variables.pageEdit', compact('page'));
	}

	public function getPageAdd() {
		return view('admin.variables.pageAdd');
	}

	public function postPageAdd() {
		Pages::create($this->request);
		return Redirect::to('admin/variables');
	}

	public function postPageEdit($id) {
		Pages::find($id)->update($this->request);
		return Redirect::to('admin/variables');
	}

	public function postPageDelete() {
		Pages::find($this->request['page_id'])->delete();
		return Redirect::back();
	}

}