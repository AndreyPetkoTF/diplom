<?php

namespace App;

use DB;
use App\Homework;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name', 'email', 'password','phone', 'logo', 'blocked', 'surname', 'patronymic', 'skype', 'birthday', 'city', 'gen_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    public function addCourses($courses) {
        foreach ($courses as $course) {
            DB::table('user_courses')->insert([
                'user_id' => $this->id,
                'course_id' => $course,
                'current_lesson_id' => 1
                ]);
        }
    }

    public function lessonDelete($lessonId) {
        $query = DB::table('user_lessons')
        ->where('lesson_id', $lessonId)
        ->where('user_id', $this->id);

        $userLessonId = $query->value('id');

        $homeworks = Homework::where('user_lesson_id', $userLessonId)->get();

        foreach ($homeworks as $homework) {
            $homework->deleteFile();
            $homework->delete();
        }

        DB::table('lesson_messages')
        ->where('lesson_id', $lessonId)
        ->where('user_id', $this->id)
        ->delete();

        $query->delete();
    }


    public function courseDelete($course) {

        $lessonIds = array_map(function($course){
            return $course['id'];
        }, $course->lessons->toArray());

        foreach ($lessonIds as $lessonId) {
            $this->lessonDelete($lessonId);
        }

        DB::table('user_courses')
        ->where('user_id', $this->id)
        ->where('course_id', $course->id)
        ->delete();
    }


    public function deleteUser() {
        $courseIds = DB::table('user_courses')
        ->where('user_id', $this->id)
        ->lists('course_id');

        foreach ($courseIds as $courseId) {
            $this->courseDelete(Course::find($courseId));
        }

        $this->block();
    }


    public function block() {
        $this->blocked = 1;
        $this->save();
    }


    public function setSlider($checked) {
        $this->slider = $checked;
        $this->save();
    }


    public function scopeSliderUsers($query) {
        $query->where('slider', 1);
    }
}
