<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $table = 'comments';
	protected $fillable = ['name', 'text', 'item_id'];

}