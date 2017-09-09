@extends('profile.layout')


@section('content')



<div class="breadcrumbs">
	<div class="breadcrumb-home">
		<img src="{{ url('/profile_images/home-icon.png') }}" alt="">
	</div>
	<div class="breadcrumb-border"></div>
	<div class="breadcrumb-item">
		Консультации
	</div>
</div>

<div class="content">
	<div class="col-lg-2 visible-lg owl">
		<img src="{{ url('/profile_images/sov/sova-1.png') }}" alt="">
	</div>
	<div class="col-lg-7 col-md-8">
		<div class="title">
			Последние сообщения
		</div>

		<div class="lessons-list">
			@foreach($userLessons as  $userLesson)
			<a href="{{ url('/profile/lesson-homework/' . $userLesson->lessonId) }}">
				<div class="lesson">
					<div class="lesson-name">
						№ {{$userLesson->name}}
					</div>
					<div class="lesson-mark 
					@if($userLesson->mark == 1 || $userLesson->mark == 2) bad @endif
					@if($userLesson->mark == 3 || $userLesson->mark == 4) normal @endif
					@if($userLesson->mark == 5) good @endif
					">
					@if($userLesson)
					{{$userLesson->mark}}
					@endif
				</div>
				<div class="lesson-message hidden-xs">
					@if($userLesson->mail)
					<img src="{{ url('/profile_images/mail.png') }}" alt="">
					@endif
				</div>
			</div>
		</a>
		@endforeach
	</div>
</div>
<div class="col-lg-3 col-md-4">
	@include('profile.components.discussion-block', ['discussions' => $discussions])
</div>
</div>
</div>

@stop