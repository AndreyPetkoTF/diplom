
@extends('profile.layout')


@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="breadcrumbs">
			<div class="breadcrumb-home">
				<a href="/profile"><img src="{{ url('/profile_images/home-icon.png') }}" alt=""></a>
			</div>
			<div class="breadcrumb-border"></div>
			<div class="breadcrumb-item">
				{{$course->name}}
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="course-page-progress">
			<div class="course-progress-text">
				Пройден на <span>{{$course->progress}}%</span>
			</div>
		</div>
		<div class="course-progress-bar hidden-xs">
			<div class="course-progress-bg" style="width: {{$course->progress}}%"></div>
		</div>
	</div>
</div>



<div class="content">
	<div class="col-lg-2 visible-lg">
		<img id="sova" src="{{ url('/profile_images/%D1%81%D0%BE%D0%B2%D0%B03.png') }}" alt="">
	</div>
	<div class="col-lg-7 col-md-8">
		<div class="row">
			<div class="col-md-10 col-sm-10 col-xs-12">
				<div class="title green">
					{{$course->name}}
				</div>
			</div>
			<div class="col-md-2 hidden-xs ">
				<div class="course-sm-logo">
					<img src="{{ url('/images/' . $course->logo) }}">
				</div>
			</div>
		</div>


		@if($course->complete)
		<form method="post" action="/profile/add-review">
			{{csrf_field()}}
			<input type="hidden" name="course_id" value="{{$course->id}}"></input>
			<div class="complete-block mt20">
				<div class="complete-message">
					Вы успешно завершили курс, теперь вы можете оценить его и оставить отзыв
				</div>
				<div class="complete-stars mt10">
					Ваша оценка курсу:<br>
					<select name="stars">
						<option value="1" @if($review && $review->stars == 1) selected @endif>1</option>
						<option value="2" @if($review && $review->stars == 2) selected @endif>2</option>
						<option value="3" @if($review && $review->stars == 3) selected @endif>3</option>
						<option value="4" @if($review && $review->stars == 4) selected @endif>4</option>
						<option value="5" @if($review && $review->stars == 5) selected @endif>5</option>
					</select>
				</div>

				<div class="complete-review">
					Ваш отзыв:<br>
					<textarea name="review">@if($review){!!$review->review!!}@endif</textarea>
				</div>

				<div class="complete-submit">
					<input type="submit"></input>
				</div>


				<div class="certificate-download">
					<a href="/profile/certificate">Скачать сертификат</a>
				</div>
			</div>
		</form>
		@endif


		<div class="lessons-list">
			@foreach($lessons as $key => $lesson)
			@if($lesson->unavail)
			<div class="lesson lesson-unavail">
				<div class="lesson-name">
					№{{$key + 1}} {{$lesson->name}}
				</div>
				<div class="lesson-mark">

				</div> 
			</div>
			@else
			<a href="{{ url('/profile/lesson/' . $lesson->id) }}">
				<div class="lesson">
					<div class="lesson-name">
						№{{$key + 1}} {{$lesson->name}}
					</div>
					<div class="lesson-mark 
					@if($lesson->mark == 1 || $lesson->mark == 2) bad @endif
					@if($lesson->mark == 3 || $lesson->mark == 4) normal @endif
					@if($lesson->mark == 5) good @endif
					">
					@if($lesson->mark)
					{{$lesson->mark}}
					@endif
				</div>
				<div class="lesson-message hidden-xs">
					@if($lesson->mail)
					<img src="{{ url('/profile_images/mail.png') }}" alt="">
					@endif
				</div>
			</div>
		</a>
		@endif
		@endforeach

	</div>
</div>
<div class="col-lg-3 col-md-4">
	@include('profile.components.discussion-block', ['discussions' => $discussions ])
</div>
</div>

@stop