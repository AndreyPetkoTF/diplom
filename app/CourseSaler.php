<?php namespace App;

use App\Interfaces\OrderTypes;

class CourseSaler {
	private $order;
	private $request;
	private $courses;


	public function __construct(OrderTypes $order, $request, $courses) {
		$this->order = $order;
		$this->request = $request;
		$this->courses = $courses;
	}


	public function create() {
		$this->order->createItem($this->request, $this->courses);
	}
}