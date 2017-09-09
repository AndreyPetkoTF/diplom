@extends('site.layout')


@section('js')
<script src="{{ url('dist/js/sovaLogin.js') }}"></script>
@stop


@section('content')
<input type="hidden" id="token" value="{{csrf_token()}}"></input>


<div  class="auth-block auth-page-block" style="display: block;">
	@if(Session::get('errors'))
	<div class="errors">
		Неправильный логин или пароль
	</div>
	@endif
	<div class="courses-title">
		<h1>
			ВОЙТИ
		</h1>
	</div>
	<div class="auth-out-form-div">
		<form method="POST" action="../auth/login">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="auth-label">
				Логин
			</div>
			<div class="auth-input">
				<input name="email">
			</div>
			<div class="auth-label">
				Пароль
			</div>
			<div class="auth-input">
				<input name="password" type="password">
			</div>
			<div class="auth-submit">
				<input type="submit" value="Войти">
			</div>
			<div class="auth-fogotten-password">
				<a href="/reset-password">Забыли пароль</a>
			</div>
		</form>
	</div>

	<img id="sova" src="{{ url('profile_images/sov/sova-1.png') }}" alt="Сова-помошник IT-школы Ирины Бузиковой">


</div>
<div class="clear"></div>
<div class="auth-to-study">
	<h4>Стать учеником</h4>
	<p>Что б стать нашим учеником - подайте заявку на интересным Вам курс</p>
	<a href="/zayavka">Подать заявку на курс</a>
</div>

@stop