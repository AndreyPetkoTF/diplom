@extends('profile.layout')

@section('js')
<script src="{{ url('dist/js/personal.js')}}"></script>
@stop


@section('content')


<div class="breadcrumbs">
	<div class="breadcrumb-home">
		<img src="{{ url('/profile_images/home-icon.png') }}" alt="">
	</div>
	<div class="breadcrumb-border"></div>
	<div class="breadcrumb-item">
		Личный кабинет
	</div>
</div>

<div class="content">

	<div class="row">
		<div class="col-lg-10 col-md-12">
			<div class="row">
				<div class="col-lg-12">
					<div class="title">
						Личный кабинет
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="avatar">
						@if(!$user->logo)
						<img src="{{ url('/profile_images/%D1%81%D0%BE%D0%B2%D0%B0.png') }}" alt="">
						@else
						<img src="{{ url('/user_logos/' . $user->logo) }}" alt="">
						@endif
					</div>


					@if(Session::get('largeFile'))
					<div class="large-file-error">
						Слишком большой файл
					</div>
					@endif

					<div class="new-avatar">
						<form  method="post" action="{{ url('/profile/personal/change-logo') }}" id="change-logo" enctype="multipart/form-data">
							{{csrf_field()}}
							<label for="logo">Загрузить другое</label>
							<input type="file" name="logo" id="logo"></input>
						</form>
					</div>
				</div>
				<div class="col-md-9">
					<div class="my-form">
						<form method="post" action="/profile/personal/update">
							{{csrf_field()}}
							<div class="row">
								<div class="col-md-2 col-md-offset-1 my-label">Фамилия:</div>
								<div class="col-md-8 my-input"><input name="surname" value="{{$user->surname}}" type="text"></div>
							</div>
							<div class="row">
								<div class="col-md-2 col-md-offset-1 my-label">Имя:</div>
								<div class="col-md-8 my-input"><input name="name" value="{{$user->name}}" type="text"></div>
							</div>
							<div class="row">
								<div class="col-md-2 col-md-offset-1 my-label">Отчество:</div>
								<div class="col-md-8 my-input"><input name="patronymic" value="{{$user->patronymic}}" type="text"></div>
							</div>
							<div class="row">
								<div class="col-md-2 col-md-offset-1 my-label">Email:</div>
								<div class="col-md-8 my-input"><input name="email" value="{{$user->email}}" type="text"></div>
							</div>
							<div class="row">
								<div class="col-md-2 col-md-offset-1 my-label">Skype:</div>
								<div class="col-md-8 my-input"><input name="skype" value="{{$user->skype}}" type="text"></div>
							</div>
							<div class="row">
								<div class="col-md-2 col-md-offset-1 my-label">Телефон:</div>
								<div class="col-md-8 my-input"><input name="phone" value="{{$user->phone}}" type="text"></div>
							</div>
							<div class="row">
								<div class="col-md-2 col-md-offset-1 my-label">Родился:</div>
								<div class="col-md-8 my-input"><input name="birthday" value="{{$user->birthday}}" type="text"></div>
							</div>
							<div class="row">
								<div class="col-md-2 col-md-offset-1 my-label">Город:</div>
								<div class="col-md-8 my-input"><input name="city" value="{{$user->city}}" type="text"></div>
							</div>
							<div class="row form-submit">
								<div class="col-md-3 col-md-offset-8">
									<button type="submit">Обновить</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-2 visible-lg">
			<img src="{{ url('/profile_images/sov/sova-2.png') }}" alt="">
		</div>
	</div>

	<div class="row">
		@foreach($courses as $course)
		@if($course->complete === 0)
		<div class="col-lg-3 col-md-6">
			<div class="course">
				<a href="/profile/course/{{$course->url}}">
					<div class="course-logo">
						<img src="{{ url('/images/' . $course->logo)  }}" alt="">
					</div>
					<div class="course-title">
						{{$course->name}}
					</div>
				</a>
				<div class="course-footer c-current">
					<a href="/profile/course/{{$course->url}}">
						<div class="course-progress">
							<div class="course-current-progress" style="width: {{$course->progress}}%">
							</div>
						</div>
					</a>
					<a href="/profile/lesson/{{$course->lesson_id}}">
						<div class="course-current-lesson">
							Текущий урок №{{$course->current_lesson_id}}
						</div>
					</a>
				</div>
			</div>
		</div>
		@else
		<div class="col-lg-3 col-md-6">
			<div class="course">
				<div class="check">
					<img src="{{ url('site_images/check-mark-3-xxl.png') }}">
				</div>
				<a href="/profile/course/{{$course->url}}">
					<div class="course-logo">
						<img src="{{ url('/images/' . $course->logo)  }}" alt="">
					</div>
					<div class="course-title">
						{{$course->name}}
					</div>
				</a>
				<div class="course-footer c-current">
					<div class="course-success-word">
						Пройден
					</div>
					<div class="course-success-mark">
						Оценка: <span>{{$course->finalMark}}</span>
					</div>
				</div>
			</div>
		</div>

		@endif
		@endforeach


	</div>
</div>
<!--        content-->
</div>

@stop