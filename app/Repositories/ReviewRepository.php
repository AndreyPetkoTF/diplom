<?php namespace App\Repositories;



class ReviewRepository {
	protected $reviews;

	public function __construct($reviews) {
		$this->reviews = $reviews;
	}

	public function getCourseStars($courseId) {
		$sum = 0;
		$count = 0;
		foreach ($this->reviews as $review) {
			if($review->course_id == $courseId){
				$sum += $review->stars;
				$count++;
			}
		}

		if(!$count) {
			return 5;
		}


		$stars = $sum / $count;

		return round($stars);
	}
}