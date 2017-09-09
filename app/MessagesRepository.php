<?php

namespace App;
use DB;
use Auth;

class MessagesRepository {

	protected $messages = [];

	public function __construct($messages) {
		$this->messages = $messages;
	}


	public function getNotReaded() {
		
	}

}