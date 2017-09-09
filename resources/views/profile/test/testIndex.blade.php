@extends('profile.layout')


@section('content')


<div class="row">
	<div class="col-lg-12 mt10">
		<div class="title green">Тест "{{$test->name}}"</div>
	</div>
</div>


<div class="row">
	<div class="col-lg-12">
		<div class="text-block">
			{!!$test->description!!}
			<p>Информация о тесте:</p>
			<p>Количество вопросов: {{$questionCount}}</p>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-3 col-md-offset-9 form-submit mt10">
		<a href="/profile/test/{{$test->id}}/question">
			<button type="submit">Начать тест</button>
		</a>
	</div>
</div>

@stop