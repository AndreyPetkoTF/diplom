<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Request;
use App\Course;
use App\Image;
use Redirect;
use App\Bid;
use Carbon\Carbon;
use App\Feedback;
use App\Order;
use App\User;
use DB;
use App\UserOrder;
use App\Review;
use App\Helper;
use App\Sendmail;

class FeedbackController extends Controller
{
	public function __construct() {
		$this->middleware('isAdmin');
		$this->request = Request::all();
		unset($this->request['_token']);
	}


	public function getIndex() {
		$orders = Order::where('user_id', 0)->get();
		$userOrders = UserOrder::withUserInfo()->get();

		$orders = $orders->merge($userOrders);

		$orders = $orders->sortByDesc('created_at');

		$orders->values()->all();

		if(!isset($_GET['page'])) {
			$page = 1;
		} else {
			$page = $_GET['page'];
		}

		$perpage = 10;

		$count = count($orders) / $perpage;
		$count = (int)$count + 1;

		$orders = $orders->forPage($page, $perpage);

		return view('admin.feedback.orders', compact('orders', 'count', 'perpage', 'page'));
	}

	public function getFeedback() {
		$feedbacks = Feedback::latest()->paginate(10);
		return view('admin.feedback.feedbackList', compact('feedbacks'));
	}

	public function getReviews() {
		$reviews = Review::mySelect()->withCourse()->withUser()->paginate(10);
		return view('admin.feedback.reviewsList', compact('reviews'));
	}

	public function getReviewEdit($id) {
		$review = Review::find($id);
		return view('admin.feedback.reviewEdit', compact('review'));
	}

	public function postReviewEdit($id) {
		Review::find($id)->update(['review' => $this->request['review']]);
		return Redirect::to('/admin/feedback/reviews');
	}

	public function getReviewDelete($id) {
		Review::find($id)->delete();
		return Redirect::back();
	}


	public function getLesson() {
		$bids = Bid::items();
		return view('admin.feedback.bidList', compact('bids'));
	}

	public function postOrderDelete() {
		Order::find($this->request['order_id'])->delete();
		return Redirect::back();
	}

	public function getSetOrderPaid($orderId) {
		$order = Order::find($orderId);
		$password = Helper::generatePassword(8);
		$order->activate(new User(), $password);

		if(!$order->user_id) {
			Sendmail::sendActivationMail($order->email, $password);
		}

		return Redirect::back();
	}


	public function getSingleOrder($id) {
		$order = Order::find($id);
		$orderCoursesIds = $order->getCourses();
		$orderCourses = Course::whereIn('id', $orderCoursesIds)->get();

		if($order->user_id) {
			$order->user = User::find($order->user_id);
		}


		return view('admin.feedback.singleOrder', compact('order', 'orderCourses'));
	}
}