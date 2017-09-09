<?php namespace App\Repositories;



class OrderCourseRepository {
	protected $orderCourse;
	protected $orderId;

	public function __construct($orderCourse, $orderId) {
		$this->orderCourse = $orderCourse;
		$this->orderId = $orderId;
	}

	public function insertByArray($courses) {
		foreach ($courses as $course) {
			$this->orderCourse->create([
				'order_id' => $this->orderId,
				'course_id' => $course->id,
				'course_name' => $course->name,
				'price' => $course->price
				]);
		}
	}
}