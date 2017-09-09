@extends('profile.layout')

@section('js')
<script src="{{ url('dist/js/discussions.js') }}"></script>
@stop


@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="breadcrumbs">
			<div class="breadcrumb-home">
				<img src="{{ url('/profile_images/home-icon.png') }}" alt="">
			</div>
			<div class="breadcrumb-border"></div>
			<div class="breadcrumb-item">
				Обсуждения
			</div>
		</div>
	</div>

</div>

<div class="content">
	<div class="col-lg-10 col-md-12">
		<div class="row">
			<!--               <div class="col-lg-12">-->
			<div class="title">
				Обсуждения
			</div>
			<!--                </div>-->
		</div>


		<div class="row mt20">
			<div class="col-md-1">
				<div class="disc-logo">
					<img src="{{ url('/profile_images/no-logo.png') }}" alt="">
				</div>
			</div>
			<div class="col-md-2 visible-lg visible-md">
				<div class="disc-label">Выберите курс</div>
				<div class="disc-label">Выберите урок</div>
			</div>
			<form method="POST" action="{{ url('/profile/discussions/add') }}">
				{{csrf_field()}}
				<div class="col-md-3">
					<div class="disc-input">
						<select name="course_id" id="course">
							<option>Выберите курс</option>
							@foreach($courses as $course)
							<option value="{{$course->id}}">{{$course->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="disc-input">
						<select name="lesson_id" id="lesson" disabled>
							<option value="0">Выберите урок</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="disc-input">
						<input name="title" placeholder="Введите заголовок"></input>
					</div>
					<div class="disc-textarea">
						<textarea name="text" placeholder="Задайте вопрос" ></textarea>
					</div>
				</div>
				<div class="col-md-2 form-submit disc-submit">
					<button type="submit">Отправить</button>
				</div>
			</form>
		</div>

		<div class="add-disc-line"></div>

		<div class="row mt10 discussion-course-list">
			<div class="col-md-4">
				<div class="title">Темя обсуждения</div>

				@foreach($courses as $course)

				<a href="{{ url('profile/discussions?course_id=' . $course->id) }}">
					<div class="course-item">
						{{$course->name}}
					</div>
				</a>

				@if(count($course->lessons))
				<div class="themes-list">
					@foreach($course->lessons as $lesson)
					<a href="{{ url('/profile/discussions?lesson_id=' . $lesson->id) }}">
						<div class="themes-item">
							<div class="themes-item-icon"></div>
							<div class="themes-item-text">{{$lesson->name}}</div>
						</div>
					</a>
					@endforeach
				</div>
				@endif
				@endforeach

			</div>

			<div class="col-md-8">
				<div class="disc-list">
					@foreach($discussions as $discussion)
					<a href="{{ url('profile/discussions/single/' . $discussion->id) }}">
						<div class="disc-item">
							<div class="disc-title">
								{{$discussion->title}}
							</div>
							<div class="disc-date hidden-xs">
								{{$discussion->created_at->format('d.m.y')}}
							</div>
							<div class="disc-date hidden-xs">
								Ответов({{$discussion->answers}})
							</div>
						</div>
					</a>
					@endforeach

				</div>
				@include('pagination.default', ['paginator' => $discussions])
			</div>
		</div>

	</div>
	<div class="col-lg-2 visible-lg">
		<img id="sova" src="{{ url('/profile_images/sov/sova-1.png') }}" alt="">
	</div>
</div>
</div>

@stop