@extends('site.pageLayout')


@section('header')
	<title>Страница заявки на курс</title>
@stop

@section('js')

<link rel="stylesheet" type="text/css" href="{{ url('datetimepicker/jquery.datetimepicker.css') }}">
<script type="text/javascript" src="{{ url('datetimepicker/build/jquery.datetimepicker.full.js') }}"></script>
<script src="{{ url('dist/js/jquery.validate.min.js') }}"></script>

<script src="{{ url('dist/js/zayavka.js') }}"></script>

@stop

@section('pageContent')

<div class="courses-title">
	<h1>ПОДАТЬ ЗАЯВКУ НА КУРС</h1>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-1">
			<div class="course-list-title">
				КУРСЫ
			</div>
			@foreach($directions as $direction)
			<div class="course-list-item">
				{{$direction->name}}
			</div>
			<div class="course-submenu">
				@foreach($direction['courses'] as $course)
				<div class="course-list-item2 col-md-offset-2" data-courseid='{{$course->id}}'>
					<div class="course-list-logo">
						<img src="{{ url('/images/' . $course->logo) }}" alt="">
					</div>
					<div class="course-name">
						{{$course->name}}
					</div>
				</div>
				@endforeach
			</div>
			@endforeach

		</div>


		<div class="col-md-6 col-md-offset-1">
			@if(Session::get('emptyOrder'))
			<div class="empty-order">
				Выберите хотя бы один курс для оформления заявки
			</div>
			@endif
			<div class="choose-course-title">
				ВЫБРАННЫЕ КУРСЫ
			</div>
			<div class="row" id="current-courses-list">
				@foreach($currentCourses as $currentCourse)
				@include('site.components.bid-item', array('course'=> $currentCourse))
				@endforeach
			</div>

			@if(!Auth::check())
			<div class="choose-course-title mt50">
				ИНФОРМАЦИЯ ОБ УЧЕНИКЕ
			</div>
			@endif


			<form method="POST" id="zayavka-form">
				{{csrf_field()}}
				<div class="row">

					<div class="bid-form mt20">
						<div class="bid-form-label col-md-10">
							Фамилия
						</div>
						<div class="bid-form-input col-md-10">
							<input type="text" name="surname" @if(Auth::check()) disabled value="{{Auth::user()->surname}}" @endif>
						</div>
						<div class="bid-form-label col-md-10">
							Имя*
						</div>
						<div class="bid-form-input col-md-10">
							<input type="text" name="name" id="name" @if(Auth::check()) disabled value="{{Auth::user()->name}}" @endif>
						</div>
						<div class="bid-form-label col-md-10">
							Отчество
						</div>
						<div class="bid-form-input col-md-10">
							<input type="text" name="patronymic" @if(Auth::check()) disabled value="{{Auth::user()->patronymic}}" @endif>
						</div>
						<div class="bid-form-label col-md-10">
							Email*
						</div>
						<div class="bid-form-input col-md-10">
							<input type="text" name="email" @if(Auth::check()) disabled value="{{Auth::user()->email}}" @endif>
						</div>

						<div class="bid-form-label col-md-10">
							Skype
						</div>
						<div class="bid-form-input col-md-10">
							<input type="text" name="skype" @if(Auth::check()) disabled value="{{Auth::user()->skype}}" @endif>
						</div>

						<div class="bid-form-label col-md-10">
							Телефон
						</div>
						<div class="bid-form-input col-md-10">
							<input type="text" name="phone" @if(Auth::check()) disabled value="{{Auth::user()->phone}}" @endif>
						</div>

						<div class="bid-form-label col-md-10">
							Дата рождения
						</div>
						<div class="bid-form-input col-md-10">
							<input type="date" id="datetimepicker" name="birthday" @if(Auth::check()) disabled value="{{Auth::user()->birthday}}" @endif>
						</div>
						<div class="bid-form-label col-md-10">
							Город
						</div>
						<div class="bid-form-input col-md-10">
							<input type="text" name="city" @if(Auth::check()) disabled value="{{Auth::user()->city}}" @endif />
						</div>


						@if(Auth::check())
						<input name="user_id" type="hidden" value="{{ Auth::id() }}" />
						@endif


						<input type="hidden" id="totalprice" name="totalprice" value="{{$totalprice}}" />

						{{--<div class="bid-form-totalprice col-md-10 mt10">--}}
							{{--Сумма: {{$totalprice}}р--}}
						{{--</div>--}}

						<div class="col-lg-6 col-lg-offset-4 bit-form-submit mt20">
							<input type="submit" value="Оформить заявку">
						</div>
					</div>

				</div>
			</form>
		</div>
	</div>
</div>

@stop