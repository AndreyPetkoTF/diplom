<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Request;
use Redirect;
use App\Discussion;
use App\DiscussionMessage;


class DiscussionController extends Controller {
	public function __construct() {
		$this->middleware('isAdmin');
		$this->request = Request::all();
		unset($this->request['_token']);
	}

	public function getIndex() {
		$discussions = Discussion::withCourseAndLessonAndCountMessages()->desc()->paginate(10);

		return view('admin.discussions.list', compact('discussions'));
	}

	public function getSingle($id) {
		$discussion = Discussion::find($id);
		$messages = DiscussionMessage::byDiscussionId($discussion->id)->withUser()->paginate(10);
		return view('admin.discussions.single', compact('discussion', 'messages'));
	}


	public function getMessageUpdate($id) {
		$message = DiscussionMessage::find($id);
		return view('admin.discussions.messageUpdate', compact('message'));
	}


	public function postMessageUpdate($id) {
		$message = DiscussionMessage::find($id);
		$message->text = $this->request['text'];
		$message->save();

		return Redirect::to('admin/discussion/single/' . $message->discussion_id );
	}

	public function postDelete($id) {
		$discussion = Discussion::find($id);

		$discussion->deleteMessages();
		$discussion->delete();

		return Redirect::back();
	}

	public function postDeleteMessage($id) {
		DiscussionMessage::find($id)->delete();
		return Redirect::back();
	}
}