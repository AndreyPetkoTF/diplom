<?php namespace App;

use Illuminate\Database\Eloquent\Model;


class OrderCourse extends Model{
	protected $table = 'order_courses';
	protected $fillable = ['order_id', 'course_id', 'course_name', 'price'];
}