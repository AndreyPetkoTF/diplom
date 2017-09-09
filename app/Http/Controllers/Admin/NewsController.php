<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Request;
use App\Course;
use App\Image;
use Redirect;
use App\News;


class NewsController extends Controller
{
	public function __construct() {
		$this->middleware('isAdmin');
		$this->request = Request::all();
		unset($this->request['_token']);
	}


	public function getIndex() {
		$news = News::items();
		return view('admin.news.newsList', compact('news'));
	}


	public function getAdd() {
		return view('admin.news.newAdd');
	}

	public function postAdd() {
		$image = new  Image(Request::file('image'));
		if($image->hasFile()) {
			$image->toImageFolder('news_images');
			$this->request['image'] = $image->getName();
		}

		News::create($this->request);

		return Redirect::to('/admin/news');
	}



	public function getEdit($news_id) {
		$newItem = News::find($news_id);
		return view('admin.news.newEdit', compact('newItem'));
	}


	public function postEdit($news_id) {
		$newItem = News::find($news_id);

		$image = new  Image(Request::file('image'));
		if($image->hasFile()) {
			$image->toImageFolder('news_images');
			Image::deleteImage($newItem->image, 'news_images');
			$this->request['image'] = $image->getName();
		}


		$newItem->update($this->request);

		return Redirect::to('admin/news');

	}


	public function postDelete() {
		News::find($this->request['news_id'])->delete();
		return Redirect::back();
	}



}
