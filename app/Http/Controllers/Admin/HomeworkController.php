<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Request;
use Redirect;
use DB;
use App\UserLesson;
use App\Message;
use App\Homework;
use Response;

class HomeworkController extends Controller
{
	public function __construct() {
		$this->middleware('isAdmin');
		$this->request = Request::all();
		unset($this->request['_token']);
	}

	public function getIndex() {
		$userLessons = UserLesson::withLessonInfo();
		$userLessons = UserLesson::setMail($userLessons, 0);

		return view('admin.homework.homeList', compact('userLessons'));
	}

	public function getFiles($userLessonsId) {
		$userLesson = UserLesson::find($userLessonsId);
		$homeworks = $userLesson->getHomeworks();
		$mark = $userLesson->mark;

		Message::current($userLesson->user_id, $userLesson->lesson_id)->isAdmin(0)->setReaded();

		$messages = Message::current($userLesson->user_id, $userLesson->lesson_id)->orderBy('lesson_messages.created_at', 'desc')->userName()->paginate(5);

		foreach ($messages as $message) {
			$message->setOwls();
		}

		return view('admin.homework.homeFiles', compact('homeworks', 'userLessonsId', 'mark', 'messages'));
	}

	public function postHomeworkDelete() {
		$homework = Homework::find($this->request['homework_id']);
		$homework->deleteFile();
		$homework->delete();
		return Redirect::back();
	}

	public function postSetMark() {
		if($this->request['mark'] >= 3) {
			UserLesson::find($this->request['userLessonId'])->setCurrentToNext();
		}

		UserLesson::find($this->request['userLessonId'])
		->update(['mark' => $this->request['mark']]);
		return Redirect::back();
	}


	public function postMessageAdd() {
		$userLesson = UserLesson::find($this->request['userLessonId']);
		Message::create([
			'user_id' => $userLesson->user_id,
			'lesson_id' => $userLesson->lesson_id,
			'message' => $this->request['message'],
			'admin' => 1
			]);

		return Redirect::back();
	}

	public function getDownload($homeworkId) {
		$item = Homework::find($homeworkId);
		$file= public_path(). "/homework_files/" . $item->file_path;
		$headers = array(
			'Content-Type: application/octet-stream',
			);
		return Response::download($file, $item->comment, $headers);
	}
}