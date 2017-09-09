<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;
use App\Interfaces\OrderTypes;
use App\Repositories\OrderCourseRepository;

class Order extends Model implements OrderTypes
{
	protected $table = 'orders';
	protected $fillable = ['name', 'surname', 'patronymic', 'email', 'skype', 'birthday', 'totalprice', 'city', 'paid', 'phone'];

	public function createItem($request, $courses) {
		$id = self::create($request)->id;

		( new OrderCourseRepository(new OrderCourse, $id) )->insertByArray($courses);
	}


	public function getCourses() {
		return DB::table('order_courses')->where('order_id', $this->id)->lists('course_id');
	}


	public function scopeUnpaid($query) {
		$query->where('paid', 0);
	}


	public function activate($user, $password) {

		if(!$this->user_id) {
			$user->email = $this->email;
			$user->password = bcrypt($password);
			$user->name = $this->name;
			$user->surname = $this->surname;
			$user->patronymic = $this->patronymic;
			$user->skype = $this->skype;
			$user->birthday = $this->birthday;
			$user->city = $this->city;
			$user->phone = $this->phone;
			$user->gen_password = $password;
			$user->save();
		} else {
			$user = $user::find($this->user_id);
		}

		$courses = $this->getCourses();

		$user->addCourses($courses);
		$this->update(['paid' => 1 ]);
	}
}