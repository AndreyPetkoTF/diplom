@extends('profile.layout')



@section('content')
<div class="content">
	<div class="row">

		@foreach($userCourses as $userCourse)
		<div class="col-lg-3 col-md-6">
			<div class="course">
				<a href="/profile/course/{{$userCourse->url}}">
					<div class="course-logo">
						<img src="{{ url('/images/' . $userCourse->logo) }}" alt="">
					</div>
					<div class="course-title">
						{{$userCourse->name}}
					</div>
					<div class="course-footer c-current">
						<div class="course-progress">
							<div class="course-current-progress" style="width: {{$userCourse->progress}}%">
							</div>
						</div>
						<a href="/profile/lesson/{{$userCourse->lesson_id}}">
							<div class="course-current-lesson">
								Текущий урок №{{$userCourse->current_lesson_id}}
							</div>
						</a>
					</div>
				</a>
			</div>
		</div>
		@endforeach

		@foreach($courses as $course)
		<div class="col-lg-3 col-md-6">
			<div class="course">
				<a href="{{ url('course/' . $course->url ) }}">
					<div class="course-logo">
						<img src="{{ url('/images/' . $course->logo) }}" alt="">
					</div>
					<div class="course-title">
						{{$course->name}}
					</div>
					<div class="course-footer c-more">
						<div class="course-more-info">
							Подробнее
						</div>
					</div>
				</a>
			</div>
		</div>
		@endforeach
	</div>
</div>
@stop