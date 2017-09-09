<?php

namespace App;
use DB;
use App\Question;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{

	protected $table = 'tests';
	protected $fillable = ['name', 'lesson_id', 'active', 'description'];


	public function questionCount() {
		return Question::where('test_id', $this->id)->count();
	}


	public function scopeWithLesson($query) {
		return $query->select('tests.*', 'lessons.name as lessonName')
		->leftjoin('lessons', 'lessons.id', '=', 'tests.lesson_id');
	}

}