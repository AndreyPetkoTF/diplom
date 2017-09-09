@extends('profile.layout')


@section('content')

<div class="row">
	<div class="col-lg-12 mt10">
		<div class="title green">Тест "{{$testName}}" - Вопрос №{{$position}}</div>
	</div>
</div>


<div class="row">
	<div class="col-lg-12">
		<div class="text-block">
			{!!$question->text!!}
		</div>
	</div>
</div>


<form method="POST" action="">
{{csrf_field()}}
	<div class="row">

		@foreach($answers as $answer)
		<div class="col-lg-12">
			<div class="answer">
				<div class="answer-radio">
					<input type="radio" name="answer" value="{{$answer->id}}">
				</div>
				<div class="answer-text">
					{{$answer->text}}
				</div>
			</div>
		</div>
		@endforeach

	</div>

	<div class="row">
		<div class="col-md-3 col-md-offset-9 form-submit mt10">
			<a href="">
				<button type="submit">Далее</button>
			</a>
		</div>
	</div>

</form>
@stop