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

	<div class="row">
		<div class="col-lg-11 col-md-10 col-sm-10 col-xs-12">
			<div class="title green">Урок №{{$lesson->position}} {{$lesson->name}}</div>
		</div>
		<div class="col-lg-1 col-sm-2 hidden-xs">
			<div class="course-sm-logo">
				<img src="{{ url('/profile_images/logo_excel.png') }}" alt="">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-xs-6">
			<div class="lesson-part ">
				<a href="{{ url('profile/lesson/' . $lesson->id) }}">
					Текст урока
				</a>
			</div>
		</div>
		<div class="col-md-3 col-xs-6">
			<div class="lesson-part ">
				<a href="{{ url('profile/lesson-homework/' . $lesson->id) }}">
					Домашнее задание
				</a>
			</div>
		</div>

		<div class="col-md-3 col-xs-6">
			<div class="lesson-part lesson-part-active">
				<a href="{{ url('profile/lesson-more/' . $lesson->id) }}">
					Дополнительная информация
				</a>
			</div>
		</div>

		<div class="col-md-2  col-xs-12 lesson-page-mark">
			@if($mark)
			Оценка: <span>{{$mark}}</span>
			@endif
		</div>
	</div>

	<div class="row">
		<div class="col-lg-10 col-xs-12">
			<div class="lesson-text">
				{!! $lesson->more_info !!}
			</div>
		</div>
		<div class="col-lg-2 visible-lg">
			<img src="{{ url('/profile_images/sov/sova-4.png') }}" alt="">
		</div>
	</div>

</div>
</div>

@stop