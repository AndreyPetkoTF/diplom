<?php

namespace App;
use DB;
use File;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
	protected $table = 'user_lesson_homeworks';
	protected $fillable = ['user_lesson_id', 'file_path', 'comment'];

	public function deleteFile() {
		if(file_exists(public_path() . '/homework_files/' . $this->file_path)  && $this->file_path !== '') {
			unlink(public_path() . '/homework_files/' .  $this->file_path);
		}
	}

}