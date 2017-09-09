<?php

namespace App\Http\Controllers\Site;

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
use App\UserOrder;
use App\CourseSaler;
use App\Review;
use App\Repositories\ReviewRepository;
use App\CourseRepository;
use App\User;
use App\Helper;

class HomeController extends Controller
{

	public function __construct() {
		$this->request = Request::all();
		unset($this->request['_token']);
	}


	public function getIndex() {
		$courses = (new CourseRepository(new Course))->sortByRate()->get(5);

		$news = News::getLast();
		$mainText = Keyval::getByKey('Текст на главной');
		$giftText = Keyval::getByKey('Подарок');
		$giftText2 = Keyval::getByKey('Подарок2');
		$lessonText = Keyval::getByKey('Получите урок');

		$sliderUsers = User::sliderUsers()->get();

		foreach ($courses as $course) {
			$course->stars = (new ReviewRepository( Review::all()))->getCourseStars($course->id);
		}


		$progressPages = Pages::progressPagesUrl()->lists('url','id');


		return view('site.index', compact('courses', 'news', 'mainText', 'giftText', 'giftText2', 'lessonText', 'sliderUsers', 'progressPages'));
	}


	public function postBidAdd() {
		Bid::create($this->request);
		return Redirect::back()->with('bidSuccess', 1);
	}

	public function postAddFeedback() {
		Feedback::create($this->request);
		return Redirect::back()->with('feedbackSuccess', 1);
	}

	public function postSendmailAdd() {
		$item = Sendmail::where('email', $this->request['email'])->first();

		// print_r($item);
		// die();

		if(empty($item)) {
			Sendmail::create($this->request);
		}

		return Redirect::back()->with('sendmailSuccess', 1);
	}

	public function getNovelty($url) {
		$novelty = News::where('url', $url)->first();
		$comments = Comment::where('item_id', $novelty->id)->get();
		return view('site.novelty', compact('novelty', 'comments'));
	}

	public function postCommentAdd() {
		Comment::create($this->request);
		return Redirect::back();
	}


	public function getNewsList() {
		$news = News::items();
		$courses = Course::getTop(2);
		return view('site.news', compact('news', 'courses'));
	}

	public function getCourses() {
		$directions = Direction::all();
		$courses = Course::all();

		foreach ($courses as $course) {
			$course->stars = (new ReviewRepository( Review::all()))->getCourseStars($course->id);
		}

		if(isset($_GET['def'])) {
			$defaultId = $_GET['def'];
		} else {
			$defaultId = '';
		}

		return view('site.courses', compact('directions', 'courses', 'defaultId'));
	}

	public function getCourse($url) {
		$course = Course::url($url)->first();
		$topCourses = Course::getTop(3, $course->id);
		$reviews = Review::where('course_id', $course->id)->withUser()->get();

		$course->stars =  (new ReviewRepository( Review::all() ))->getCourseStars($course->id);


		foreach ($topCourses as $topCoursesItem) {
			$topCoursesItem->stars = (new ReviewRepository( Review::all()))->getCourseStars($topCoursesItem->id);
		}


		return view('site.coursePage', compact('course', 'topCourses', 'reviews'));
	}


	public function getContacts() {
		$contactsText = Keyval::getByKey('Текст в контактах');
		return view('site.contacts', compact('contactsText'));
	}

	public function getP($url) {
		$page = Pages::where('url', $url)->first();
		return view('site.staticPage', compact('page'));
	}

	public function getAbout() {
		$page = Pages::where('url', 'about')->first();
		return view('site.staticPage', compact('page'));
	}

	public function getPartners() {
		$page = Pages::where('url', 'partners')->first();
		return view('site.staticPage', compact('page'));
	}


	public function getAddZayavka($course_id = 0) {
		if($course_id) {
			$courses = Session::get('courses');

			if(!isset($courses)) {
				$courses = [];
			}

			if(array_search($course_id,$courses) === false) {
				$courses[] = $course_id;
				Session::put('courses', $courses);
				Session::save();
			}
		}

		return Redirect::to('/zayavka');
	}

	public function getZayavka() {
		$directions = Course::groupByDirection(Direction::all());
		$coursesIds = Session::get('courses');

		$currentCourses = Course::whereIn('id', $coursesIds)->get();
		$totalprice = Course::totalPrice($coursesIds);

		return view('site.zayavka', compact('directions', 'currentCourses', 'totalprice'));
	}

	public function postZayavka() {
		$coursesId = Session::get('courses');

		if(empty($coursesId)) {
			return Redirect::back()->with('emptyOrder', 1);
		}

		$courses = Course::whereIn('id', $coursesId)->get();

		if(isset($this->request['user_id'])) {
			$order = new UserOrder;
		} else {
			$order = new Order;
		}

		$saler = new CourseSaler($order, $this->request, $courses);
		$saler->create();

		Session::put('courses', []);

		$order = Order::orderBy('created_at', 'desc')->first();
		$lastInsertId = $order->id;


		return Redirect::to('/success')->with('lastInsertId', $lastInsertId);
	}


	public function getBlocked() {
		return view('site.blocked');
	}

	public function getSuccess() {
		$news = News::getLast();

		$order_id = Session::get('lastInsertId');

		if($order_id) {
			$order = Order::find($order_id);
			return view('site.success', compact('news', 'order'));
		} else {
			return Redirect::to('/');
		}

	}

	public function getPage($url) {
		$page = Pages::where('url', $url)->first();
		return view('site.staticPage', compact('page'));
	}


	public function getSuccessPay() {
		$news = News::getLast();
		return view('site.success-pay', compact('news'));
	}

	public function pay() {
		$orderId = $_POST['ik_pm_no'];
		$status = $_POST['ik_inv_st'];

		if($status == 'success') {
			$password = Helper::generatePassword(8);
			$order = Order::find($orderId);
			$order->activate(new User(), $password);

			if(!$order->user_id) {
				Sendmail::sendActivationMail($order->email, $password);
			}
		}
	}

	public function getUnsub($id) {
		Sendmail::where('id', $id)->delete();
		return Redirect::to('/success-unsub');
	}


	public function getSuccessUnsub() {
		return view('site.success-unsub');
	}


	public function getResetPassword() {
		return view('auth.password');
	}

	public function getHome() {
		return Redirect::to('/');
	}


}
