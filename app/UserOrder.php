<?php namespace App;

use App\Interfaces\OrderTypes;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\OrderCourseRepository;

class UserOrder extends Model implements OrderTypes {
	protected $table = 'orders';
	protected $fillable = ['user_id', 'totalprice'];

	public function createItem($request, $courses) {
		$orderId = self::create($request)->id;

		(new OrderCourseRepository(new OrderCourse, $orderId) )->insertByArray($courses);
	}

	public function scopeWithUserInfo($query) {
		$query->select('orders.*', 'users.name as name', 'users.phone as skype')
		->where('user_id', '!=', 0)
		->leftjoin('users', 'users.id', '=',  'orders.user_id');
	}
}