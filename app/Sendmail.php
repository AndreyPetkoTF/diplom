<?php

namespace App;
use DB;
use Mail;

use Illuminate\Database\Eloquent\Model;

class Sendmail extends Model
{

	public $timestamps = false;
	protected $table = 'sendmail';
	protected $fillable = ['user_id', 'email'];


	public static function sendActivationMail($email, $password) {
		Mail::send('emails.activation', ['email' => $email, 'password' => $password], function($message) use ($email)
		{
			$message->to($email, 'ИТ-школа Ирины Бузиковой')->subject('Ваш аккаунт создан');
		});
	}

}