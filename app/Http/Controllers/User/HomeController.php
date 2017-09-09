<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Request;
use App\Course;
use Auth;
use App\News;
use App\Bid;
use Redirect;
use App\Keyval;
use App\Direction;
use App\Comment;
use App\Feedback;
use App\Sendmail;
use App\Pages;
use Session;
use App\Order;
use App\Lesson;
use App\Message;
use App\Helper;
use App\UserLesson;
use App\Discussion;
use App\MessagesRepository;
use App\User;
use App\DiscussionsRepository;
use App\Security;
use App\Review;
use Illuminate\Pagination\Paginator;
use App\Test;
use App\UserTest;
use mPDF;
use View;

class HomeController extends Controller
{

	public function __construct() {
		$this->middleware('auth');
		$this->request = Request::all();
		unset($this->request['_token']);
	}


	public function getIndex() {
		$user_id = Auth::user()->id;
		$userCourses = Course::getUserItems($user_id);

		$userCourseId = [];

		foreach ($userCourses as $key => $userCourse) {
			$userCourseId[] = $userCourse->id;

			$course = Course::find($userCourse->id);
			$course->getCourseComplete($user_id);

			if($userCourse->lessons && $course->complete == 0) {

				$userCourse->progress = Course::getProgress($userCourse, $user_id);
				$userCourse->lesson_id = Course::getRealLessonId($userCourse);

			} else {
				unset($userCourses[$key]);
			}
		}


		$courses = Course::getOther($userCourseId);

		return view('profile.dashboard', compact('courses', 'userCourses'));
	}


	public function getCertificate() {
		$html = view('pdf.certificate-new')->render();

		$mpdf = new mPDF('utf-8', 'A4', '8', '', 10, 10, 7, 7, 10, 10); /*задаем формат, отступы и.т.д.*/

		$stylesheet = file_get_contents(url('dist/css/certificate.css'));
		$mpdf->WriteHTML($stylesheet, 1);

		$mpdf->list_indent_first_level = 0; 
		$mpdf->WriteHTML($html, 2); /*формируем pdf*/
		$mpdf->Output('mpdf.pdf', 'I');

		// $data = [];
		// $pdf = PDF::loadView('pdf.certificate-new', $data);
		// return $pdf->download('certificate.pdf');

	}


	public function getHi() {
		return view('pdf.certificate-new');
	}


	public function getCourse($url) {
		$course = Course::url($url)->first();
		$course->getCourseProgress();
		$course->getCourseComplete(Auth::id());

		$lessons = $course->lessons;

		$userId = Auth::user()->id;

		foreach ($lessons as $lesson) {
			$lesson->getMark($userId);
			if($lesson->position > $course->currentLesson()) {
				$lesson->unavail = 1;
			}

			$lesson->mail = Message::current($userId, $lesson->id)->isAdmin(1)->notReaded()->count();
		}

		$discussions = Discussion::where('course_id', $course->id)->limit(7)->get();
		$discussionsList = new DiscussionsRepository($discussions);
		$discussions = $discussionsList->setCountAnswers();

		$review = Review::current(Auth::id(), $course->id)->first();

		return view('profile.course', compact('course', 'lessons', 'discussions', 'review'));
	}

	public function getLesson($id) {
		if(!Security::check($id)) {
			return Redirect::to('/profile');
		}

		$lesson = Lesson::find($id);


		$course = Course::find($lesson->course_id);

		$userLesson = UserLesson::getInstance(Auth::user()->id, $id);

		if($userLesson) {
			$mark = $userLesson->getMark();
		} else {
			$mark = 0;
		}

		return view('profile.lesson', compact('lesson', 'mark', 'course'));
	}

	public function getLessonHomework($id) {
		if(!Security::check($id)) {
			return Redirect::to('/profile');
		}


		$test = Test::where('lesson_id', $id)->first();

		if($test) {
			$test->userTest = UserTest::current(Auth::id(), $test->id)->first();
		}

		$userId = Auth::user()->id;


		$pages = Message::current($userId, $id)->paginate(5);
		$lastPage = $pages->lastPage();


		if(!isset($_GET['page'])) {
			Paginator::currentPageResolver(function() use ($lastPage) {
				return $lastPage;
			});
		}


		Message::current($userId, $id)->isAdmin(1)->setReaded();

		$messages = Message::current($userId, $id)->paginate(5);

		foreach ($messages as $message) {
			$message->setOwls();
		}

		$lesson = Lesson::find($id);

		$course = Course::find($lesson->course_id);

		$userLesson = UserLesson::getInstance($userId, $id);

		if($userLesson) {
			$mark = $userLesson->getMark();
			$files = $userLesson->files();
		} else {
			$mark = 0;
			$files = [];
		}


		$discussions = Discussion::where('lesson_id', $id)->limit(7)->get();
		$discussionsList = new DiscussionsRepository($discussions);
		$discussions = $discussionsList->setCountAnswers();


		return view('profile.lesson-homework', compact('lesson', 'messages', 'files', 'mark', 'discussions', 'test', 'course'));
	}


	public function getLessonMore($id) {
		if(!Security::check($id)) {
			return Redirect::to('/profile');
		}



		$lesson = Lesson::find($id);

		$userLesson = UserLesson::getInstance(Auth::user()->id, $id);

		if($userLesson) {
			$mark = $userLesson->getMark();
		} else {
			$mark = 0;
		}

		return view('profile.lesson-more', compact('lesson', 'mark'));
	}

	public function postAddLessonMessage() {
		$created = UserLesson::current(Auth::id(), $this->request['lesson_id'])->count('id');

		if(!$created) {
			UserLesson::create([
				'user_id' => Auth::id(),
				'lesson_id' => $this->request['lesson_id'],
				]);
		}

		$message = new Message;
		$message->message = $this->request['message'];
		$message->user_id = Auth::user()->id;
		$message->admin = 0;
		$message->lesson_id = $this->request['lesson_id'];
		$message->save();

		return Redirect::back();
	}

	public function postAddHomework() {
		$filename = '';

		if(empty($this->request)) {
			return Redirect::back()->with('largeFile', 1);
		}


		if(Request::hasFile('file') && Request::file('file')->isValid()) {
			$extension =  Request::file('file')->getClientOriginalExtension();
			$filename = uniqid() . '.' . $extension;
			Request::file('file')->move('homework_files', $filename);
		}


		$userLesson = UserLesson::getInstance(Auth::user()->id, $this->request['lesson_id']);

		if(!$userLesson) {
			$userLesson = UserLesson::create([
				'user_id' => Auth::user()->id,
				'lesson_id' => $this->request['lesson_id'],
				'mark' => 0
				]);
		}

		$userLesson->addHomework($filename, $this->request['comment']);
		return Redirect::back();
	}

	public function getConsultations() {
		$userId = Auth::user()->id;
		$userLessons = UserLesson::consultations($userId)->get();
		$userLessons = UserLesson::setMail($userLessons, 1);

		$discussions = Discussion::latest()->take(7)->get();
		$discussionsList = new DiscussionsRepository($discussions);
		$discussions = $discussionsList->setCountAnswers();


		return view('profile.consultations', compact('userLessons', 'discussions'));
	}


	public function postAddReview() {

		$review = Review::firstOrNew(['course_id' => $this->request['course_id'], 'user_id' => Auth::id()]);

		$review->stars = $this->request['stars'];
		$review->review = $this->request['review'];
		$review->save();

		return Redirect::back();
	}


}