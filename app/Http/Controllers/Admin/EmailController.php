<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Http\Requests;

use Request;
use App\Sendmail;
use Redirect;
use Mail;



class EmailController extends Controller
{
	public function __construct() {
		$this->middleware('isAdmin');
		$this->request = Request::all();
		unset($this->request['_token']);
	}


	public function getIndex() {
		$emails = Sendmail::all();

		return view('admin.email.index', compact('emails'));
	}

	public function postIndex() {
		$emails = $this->request['emails'];

		foreach ($emails as $email) {
			if(isset($email['on'])) {
				$mail = $email['email'];

				$sub = Sendmail::where('email', $mail)->first();
				$id = $sub->id;

				Mail::send('emails.empty', ['text' => $this->request['message'], 'id' => $id], function($message) use ($mail)
				{
					$message->to($mail, 'ИТ-школа Ирины Бузиковой')->subject('Рассылка по подписчикам школы');
				});
			}
		}

		return Redirect::to('admin/email/success');
	}

	public function getSuccess() {
		return view('admin.email.success');
	}


	public function getSubscribers() {
		$subs = Sendmail::all();
		return view('admin.email.subs', compact('subs'));
	}


	public function postDelete() {
		Sendmail::where('id', $this->request['sub_id'])->delete();
		return Redirect::back();
	}


	public function postAdd() {
		Sendmail::create($this->request);
		return Redirect::back();
	}
}