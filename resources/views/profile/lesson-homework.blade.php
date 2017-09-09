@extends('profile.layout')

@section('js')
<script src="{{ url('dist/js/smiles.js')}} "></script>
@stop


@section('content')




@if(Session::get('largeFile'))

@endif

<div class="breadcrumbs">
	<div class="breadcrumb-home">
		<a href="/profile"><img src="{{ url('/profile_images/home-icon.png') }}" alt=""></a>
	</div>
	<div class="breadcrumb-border"></div>
	<div class="breadcrumb-item">
		<a href="/profile/course/{{$course->url}}">{{$course->name}}</a>
	</div>
	<div class="breadcrumb-border"></div>
	<div class="breadcrumb-item">
		{{$lesson->name}}
	</div>
</div>

<div class="content">

	<div class="row">
		<div class="col-lg-11 col-md-10 col-sm-10 col-xs-12">
			<div class="title green">Урок №{{$lesson->position}} {{$lesson->name}}</div>
		</div>
		<div class="col-lg-1 col-sm-2 hidden-xs">
			<div class="course-sm-logo">
				<img src="{{ url('/images/' . $course->logo) }}">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-xs-6">
			<div class="lesson-part">
				<a href="{{ url('profile/lesson/' . $lesson->id) }}">
					Текст урока
				</a>
			</div>
		</div>
		<div class="col-md-3 col-xs-6">
			<div class="lesson-part lesson-part-active">
				<a href="{{ url('profile/lesson-homework/' . $lesson->id) }}">
					Домашнее задание
				</a>
			</div>
		</div>


		@if($lesson->more_info)
		<div class="col-md-3 col-xs-6">
			<div class="lesson-part ">
				<a href="{{ url('profile/lesson-more/' . $lesson->id) }}">
					Дополнительная информация
				</a>
			</div>
		</div>
		@endif


		@if($mark && $mark >= 3)
		<div class="col-md-2 col-xs-12 lesson-page-mark">
			Оценка: <span>{{$mark}}</span>
		</div>
		@endif


		@if($mark && $mark < 3)
		<div class="col-md-2 col-xs-12 lesson-page-mark bad-lesson-page-mark">
			Оценка: <span>{{$mark}}</span>
		</div>
		@endif
	</div>

	<div class="row">
		<div class="col-xs-12">
			<div class="lesson-text">
				{!!$lesson->home_text!!}
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-2 visible-lg max100">
			@if($mark == '')
			<img id="sova" src="{{ url('/profile_images/sov/sova-4.png') }}" alt="">
			@endif

			@if($mark >= 3)
			<img  id="sova" src="{{ url('/profile_images/sov/sova-6.png') }}" alt="">
			@endif

			@if($mark != '' && $mark < 3)
			<img id="sova" src="{{ url('/profile_images/sov/sova-5.png') }}" alt="">
			@endif
		</div>
		<div class="col-lg-7 col-md-8">
			<div class="title">
				Отправить домашнее задание
			</div>

			<div class="row">
				<div class="col-sm-2 hidden-xs">
					@if($mark && $mark >= 3)
					<div class="mt20">
						<img src="{{ url('/profile_images/check-mark-3-xxl.png') }}" alt="">
					</div>
					@endif
				</div>
				<div class="col-sm-7 col-xs-9">
					<div class="homework-title">
						Домашнее задание отправлено
					</div>
					<div class="files-list">
						@foreach($files as $file)
						<div class="themes-item">
							<div class="themes-item-icon"></div>
							<div class="themes-item-text filename">@if($file->comment) {{$file->comment}} @else Новый файл @endif</div>
						</div>
						@endforeach

						@if(Session::get('largeFile'))
						<div class="large-file-error">
							Слишком большой файл
						</div>
						@endif
					</div>

					<div class="send-more">
						<form method="post" action="/profile/add-homework" enctype="multipart/form-data" class="file-input">
							{{csrf_field()}}
							<input type="hidden" value="{{$lesson->id}}" name="lesson_id"></input>
							<input type="file" id="file" name="file" style="display: none;"></input>
							<label for="file" id="file-label" class="file-label">Выберите файл</label>
							<textarea name="comment"></textarea>
							<div class="row">
								<div class="form-submit col-md-4 col-md-offset-8 mt0">
									<button type="submit">Отправить</button>
								</div>
							</div>
						</form>
					</div>



					@if($test && $test->active)
					@if($test->userTest)
					<a href="/profile/test/{{$test->id}}/restart">
						<div class="test-button">
							Пройти тест повторно ({{$test->userTest->mark}}/{{$test->userTest->current_position - 1}})
						</div>
					</a>
					@else
					<a href="/profile/test/{{$test->id}}">
						<div class="test-button">
							Пройти тест
						</div>
					</a>
					@endif
					@endif

				</div>
				@if($mark && $mark >= 3)
				<div class="col-xs-3 lesson-page-mark-bot good-mark">
					Оценка <span>{{$mark}}</span>
				</div>
				@endif

				@if($mark && $mark < 3)
				<div class="col-xs-3 lesson-page-mark-bot bad-mark">
					Оценка <span>{{$mark}}</span>
				</div>
				@endif
			</div>
			<div class="one-disc-line mt10"></div>

			<div class="answer-list">
				@if(count($messages) != 0)
				@foreach($messages as $message)
				<div class="one-answer">
					<div class="row">
						<div class="col-md-offset-1 col-xs-2">
							<div class="user-logo">
								@if($message->admin)
								<img src="{{ url('/profile_images/112965409_suychik.png') }}" alt="">
								@else
								<img src="{{ url('/user_logos/' . Auth::user()->logo) }}">
								@endif
							</div>
							<div class="user-name">
								@if($message->admin)
								Admin
								@else
								{{Auth::user()->name}}
								@endif
							</div>
						</div>
						<div class="col-xs-7">
							<div class="one-disc-text">
								{!!$message->message!!}
							</div>
						</div>
						<div class="col-xs-2">
							<div class="one-disc-date">
								{{$message->created_at->format('h:i:s d.m.y')}}
							</div>
						</div>
					</div>
				</div>
				@endforeach
				@else
				<div class="empty-messages">
					Переписка пуста
				</div>
				@endif

			</div>
			@include('pagination.default', ['paginator' => $messages])

			<div class="row">
				<form method="POST" action="/profile/add-lesson-message">
					{{csrf_field()}}
					<input type="hidden" name="lesson_id" value="{{$lesson->id}}"></input>
					<div class="new-answer-row">
						<div class="col-md-11 col-md-offset-1 answer-area">
							<textarea placeholder="Введите сообщение" id="discussionText" name="message"></textarea>
						</div>
						<div class="col-md-3 col-md-offset-9 form-submit mt10">
							<button type="submit">Отправить</button>
						</div>
					</div>
				</form>
			</div>
			<div class="row smiles">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="row">
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s1.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s2.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s3.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s4.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s5.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s6.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s7.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s8.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s9.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s10.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s11.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s12.png') }}"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-4">
			@include('profile.components.discussion-block', ['discussions' => $discussions])
		</div>

	</div>
</div>

@stop