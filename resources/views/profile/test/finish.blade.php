@extends('profile.layout')


@section('content')


<div class="row">
	<div class="col-lg-12 mt10">
		<div class="title green">Вы завершили тест!</div>
	</div>
</div>


<div class="row">
	<div class="col-lg-12">
		<div class="text-block">
			<p>Вы завершили тест {{$testName}}!</p>
			<p>Ваш результат: {{$userTest->mark}}/{{$questionsCount}}</p>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-3 col-md-offset-9 form-submit mt10">
		<a href="/profile/lesson-homework/{{$lesson_id}}">
			<button type="submit">Вернуться к уроку</button>
		</a>
	</div>
</div>

@stop