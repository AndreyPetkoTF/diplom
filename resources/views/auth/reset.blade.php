@extends('site.layout')


@section('content')

<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="news-title mt20">
				<h1>Востановление пароля</h1>
			</div>
		</div>
	</div>


	<form method="POST" action="/password/reset">
		{!!csrf_field()!!}
		<input type="hidden" name="token" value="{{ $token }}">

		@if (count($errors) > 0)
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
		@endif


		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="text" class="form-control" name="email" id="email" value="{{old('email')}}"/>
				</div>


				<div class="form-group">
					<label for="password">Новый пароль</label>
					<input type="password" class="form-control" name="password" id="password" />
				</div>

				<div class="form-group">
					<label for="password_confirmation">Повторите новый пароль</label>
					<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" />
				</div>

			</div>




			<div class="col-md-12">
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Отправить</button>
				</div>
			</div>

		</div>

	</form>

</div>

@stop