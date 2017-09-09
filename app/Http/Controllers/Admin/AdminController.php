<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Request;
use App\Order;
use App\Message;
use App\User;



class AdminController extends Controller
{

	public function __construct() {
		$this->middleware('isAdmin');
		$this->request = Request::all();
		unset($this->request['_token']);
	}


	public function getIndex() {
		$ordersCount = Order::unpaid()->count('id');

		$newMessages = Message::IsAdmin(0)->notReaded()->count('id');

		$usersCount = User::count('id');

		return view('admin.index', compact('ordersCount', 'newMessages', 'usersCount'));
	}

}
