@extends('site.pageLayout')


@section('header')
<title>Страница курса "{{$course->name}}"</title>
@stop


@section('js')
<script type="text/javascript" src="{{url('dist/js/course-tabs.js')}}"></script>
@stop


@section('pageContent')

<!--   content-->
<div class="container">
	<div class="courses-title">
		<h1>КУРСЫ</h1>
	</div>
	<div class="breadcrumbs">
		<a href="/">
			<div class="breadcrumb-item">
				Главная
			</div>
		</a>
		<div class="breadcrumb-icon">
			<img src="{{ url('/site_images/breadcrumbs-item.png') }}" alt="">
		</div>
		<a href="/courses">
			<div class="breadcrumb-item">
				Курсы
			</div>
		</a>
		<div class="breadcrumb-icon">
			<img src="{{ url('/site_images/breadcrumbs-item.png') }}" alt="">
		</div>
		<div class="breadcrumb-item">
			{{$course->name}}
		</div>
	</div>

	<div class="row mt60">
		<div class="col-md-5">
			<div class="course-image">
				<div>
					<div>
						<img src="{{ url('/images/' . $course->logo) }}" alt="">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="course-page-title">
				{{$course->name}}
			</div>
			<div class="row mt20">
				<div class="course-page-price">
					{{--Цена: <span>{{$course->price}}р</span>--}}
				</div>
				<div class="course-page-stars">
					@include('site.components.stars', ['stars' => $course->stars])
				</div>
				<div class="course-page-rate">
					Рейтинг: 
				</div>

			</div>
			<div class="row mt20 course-page-text">
				<div class="col-lg-12">
					{!!$course->description!!}
				</div>
			</div>
			<div class="row mt10">

				<div class="col-md-5 sub-button-link">
					<a href="{{ url('/add-zayavka/' . $course->id) }}">
						<div class="sub-button">
							Записаться на курс
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="course-tabs">
			<div class="course-tab" id="description-tab">
				Описание
			</div>

			<div class="course-tab" id="program-tab">
				Программа курса
			</div>
		</div>
	</div>

	<div class="row mt20">
		<div class="col-lg-12" id="description">
			<div class="course-page-full-text">
				{!!$course->fullDescription!!}
			</div>
		</div>

		<div class="col-lg-12" id="program">
			<div class="course-page-full-text">
				{!!$course->program!!}
			</div>
		</div>
	</div>


	@if(count($reviews))
	<div class="courses-title">
		<h2>ОТЗЫВЫ НАШИХ СТУДЕНТОВ</h2>
	</div>
	@endif

	<div class="review-list">

		@foreach($reviews as $review)
		<div class="row">
			<div class="review-item">
				<div class="col-md-1 col-xs-3 col-md-offset-1">
					<div class="review-logo">
						@if($review->logo)
						<img src="{{ url('user_logos/' . $review->logo	) }}">
						@else
						<img src="{{ url('/profile_images/112965409_suychik.png') }}">
						@endif
					</div>
				</div>
				<div class="col-md-9 col-xs-9">
					<div class="row">
						<div class="review-user">
							{{$review->name}}
						</div>

						<div class="review-stars">
							@if($review->stars >= 1)
							<img src="{{ url('site_images/stars.png') }}">
							@else
							<img src="{{ url('site_images/star-empty.png') }}">
							@endif

							@if($review->stars >= 2)
							<img src="{{ url('site_images/stars.png') }}">
							@else
							<img src="{{ url('site_images/star-empty.png') }}">
							@endif

							@if($review->stars >= 3)
							<img src="{{ url('site_images/stars.png') }}">
							@else
							<img src="{{ url('site_images/star-empty.png') }}">
							@endif

							@if($review->stars >= 4)
							<img src="{{ url('site_images/stars.png') }}">
							@else
							<img src="{{ url('site_images/star-empty.png') }}">
							@endif

							@if($review->stars >= 5)
							<img src="{{ url('site_images/stars.png') }}">
							@else
							<img src="{{ url('site_images/star-empty.png') }}">
							@endif

						</div>
					</div>
					<div class="row mt10">
						<div class="col-xs-12 review-text">
							{!!$review->review!!}
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach

	</div>


	<div class="courses-title">
		<h2>РЕКОМЕНДУЕМ</h2>
	</div>
	<div class="row">
		@foreach($topCourses as $topCourse)
		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 grid-item category">
			<div class="course-item">
				<a href="{{ url('/course/' . $topCourse->url)}}">
					<div class="course-logo">
						<img src="{{ url('/images/' . $topCourse->logo) }}" alt="">
					</div>
				</a>
				<div class="row">
					<div class="course-stars">
						@include('site.components.stars', ['stars' => $topCourse->stars])
					</div>
				</div>

				<div class="row">
					<a href="{{ url('/course/' . $topCourse->url)}}">
						<div class="course-title">
							{{$topCourse->name}}
						</div>
					</a>
				</div>

				<div class="row">
					<div class="course-text">
						{!!$topCourse->description!!}
					</div>
				</div>

				<div class="row course-buttons">
					<a href="/course/{{$topCourse->url}}">
						<div class="course-more">
							Подробнее
						</div>
					</a>
					<a href="{{ url('/add-zayavka/' . $topCourse->id) }}">
						<div class="course-buy">
							Записаться на курс
						</div>
					</a>
				</div>
			</div>
		</div>
		@endforeach


	</div>

</div>
<!-- /content-->

@stop