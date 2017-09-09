<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	protected $table = 'question_answers';
	protected $fillable = ['question_id', 'text', 'right'];

}