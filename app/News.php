<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	protected $table = 'news';
	protected $fillable = ['name', 'text', 'image', 'description', 'url'];


	public static function items() {
		return DB::table('news')
		->select(DB::raw('count(comments.id) as comments, news.*'))
		->leftjoin('comments', 'news.id', '=', 'comments.item_id')
		->orderBy('id', 'desc')
		->groupBy('news.id')
		->paginate(4);
	}


	public static function getLast() {
		return DB::table('news')->orderBy('id', 'desc')->take(4)->get();
	}
}