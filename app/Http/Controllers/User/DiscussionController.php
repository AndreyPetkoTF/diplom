<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Course;
use App\Discussion;
use Request;
use App\DiscussionMessage;
use Auth;
use Redirect;
use Illuminate\Pagination\Paginator;
use App\DiscussionsRepository;


class DiscussionController extends Controller
{

	public function __construct() {
		$this->middleware('auth');
		$this->request = Request::all();
		unset($this->request['_token']);
	}


	public function getIndex() {
		$courses = Course::all();
		$discussions = Discussion::getByFilter($_GET);

		$discussionsList = new DiscussionsRepository($discussions);

		$discussions = $discussionsList->setCountAnswers();

		return view('profile.discussions', compact('courses', 'discussions'));
	}


	public function postAdd() {
		$discussion = $this->request;
		unset($discussion['text']);
		$discId = Discussion::create($discussion)->id;

		DiscussionMessage::create([
			'user_id' => Auth::user()->id,
			'discussion_id' => $discId,
			'text' => $this->request['text']
			]);

		return Redirect::back();
	}

	public function getSingle($discussionId) {
		$discussion = Discussion::find($discussionId);
		$firstMessage = DiscussionMessage::where('discussion_id', $discussionId)->withUser()->first();

		$pages = DiscussionMessage::where('discussion_messages.id', '!=', $firstMessage->messageId)
		->where('discussion_id', $discussionId)
		->paginate(5);

		$lastPage = $pages->lastPage();

		if(!isset($_GET['page'])) {
			Paginator::currentPageResolver(function() use ($lastPage) {
				return $lastPage;
			});
		}

		$messages = DiscussionMessage::where('discussion_messages.id', '!=', $firstMessage->messageId)
		->where('discussion_id', $discussionId)
		->orderBy('discussion_messages.id')
		->withUser()
		->paginate(5);



		$discussions = Discussion::where('course_id', $discussion->course_id)->limit(7)->get();
		$discussionsList = new DiscussionsRepository($discussions);
		$discussions = $discussionsList->setCountAnswers();


		foreach ($messages as $message) {
			$message->setOwls();
		}

		return view('profile.single-discussion', compact('discussion', 'firstMessage', 'messages', 'discussions'));
	}

	public function postMessageAdd() {
		DiscussionMessage::create([
			'user_id' => Auth::user()->id,
			'discussion_id' => $this->request['discussion_id'],
			'text' => $this->request['text']
			]);

		return Redirect::back();
	}

}