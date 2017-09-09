<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	@yield('header')
	<link rel="stylesheet" type="text/css" href="{{ url('bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ url('dist/css/site.css') }}">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

	<div id="auth-block" class="auth-block">
		<form method="POST" action="auth/login">
			{!! csrf_field() !!}
			<div class="auth-close" id="auth-close">X</div>
			<div class="auth-title">Войти</div>
			<div class="auth-label">
				Логин
			</div>
			<div class="auth-input">
				<input name="email"></input>
			</div>
			<div class="auth-label">
				Пароль
			</div>
			<div class="auth-input">
				<input name="password" type="password"></input>
			</div>
			<div class="auth-submit">
				<input type="submit" value="Войти"></input>
			</div>
		</form>
	</div>


	<div id="nav-bg"></div>


	<div id="nav">
		<ul>
			<li><a href="{{ url('/') }}" >Главная</a></li>
			<li><a href="{{ url('about') }}" >О школе</a></li>
			<li id="subMenuButton"><a href="{{ url('courses') }}" >Курсы</a></li>
			<li><a href="{{ url('/page/Nashi-dostizheniya') }}" >Достижения</a></li>
			<ul id="subMenu">

				@foreach($menuDirections as $direction)
				<ul class="ulList">
					@foreach($direction->courses as $menuCourse)
					<a href="{{ url('/course/' . $menuCourse->url) }}"><li>{{$menuCourse->name}}</li></a>
					@endforeach
				</ul>
				<a href="{{ url('/courses?def=' . $direction->id) }}"  class="subMenuA" > <li>{{$direction->name}}</li></a>
				@endforeach



			</ul>
			<li><a href="{{ url('partners') }}" >Партнерам</a></li>
			<li><a href="{{ url('news-list') }}" >Новости</a></li>
			<li><a href="{{ url('contacts') }}" >Контакты</a></li>
		</ul>
		<div id="mobile-button">
			<div></div>
			<div></div>
			<div></div>
		</div>


		<a href="/profile"><div class="button-student">Я УЧЕНИК</div></a>
		<!-- <a href="/profile"><div class="button-student">Я УЧЕНИК</div></a> -->
		<a href="{{ url('zayavka') }}"><div id="new-student" class="button-new-student">ПОДАТЬ ЗАЯВКУ</div></a>
	</div>


	<div id="mobile-menu">
		<ul>
			<li><a href="{{ url('/') }}" >Главная</a></li>
			<li><a href="{{ url('/about') }}" >О школе</a></li>
			<li><a href="{{ url('courses') }}" >Курсы</a></li>
			<li><a href="{{ url('/page/Nashi-dostizheniya') }}" >Достижения</a></li>
			<li><a href="{{ url('partners') }}" >Партнерам</a></li>
			<li><a href="{{ url('news-list') }}" >Новости</a></li>
			<li><a href="{{ url('contacts') }}" >Контакты</a></li>
		</ul>
	</div>

	@yield('content')

	<div id="arrow-up"><img src="{{ url('/site_images/arrow-up.png') }}"></div>
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-2 hidden-xs">
					<div class="footer-logo">
						<img src="{{ url('/site_images/logo-footer.png') }}" alt="">
					</div>
				</div>
				<div class="col-md-10">
					<div class="footer-links">
						<div class="footer-link"><a href="/">Главная</a></div>
						<div class="footer-link"><a href="/about">О школе</a></div>
						<div class="footer-link"><a href="/page/publichnaya-oferta">Публичная оферта</a></div>
						<div class="footer-link"><a href="/page/politika-konfidenczialbnosti">Политика конфиденциальности</a></div>
						<div class="footer-link"><a href="/page/faq">FAQ</a></div>
						<div class="footer-link"><a href="/page/sposoby-oplaty">Способы оплаты</a></div>
						<div class="footer-link"><a href="/partners">Партнерам</a></div>
						<div class="footer-link"><a href="/contacts">Контакты</a></div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-copy-social">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="copyright">
							IT-школа Ирины Бузиковой. Все права защишены.
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<div class="footer-social">
							<a href="#"><img src="{{ url('/site_images/icon-insta.jpg') }}" alt=""></a>
							<a href="#"><img src="{{ url('/site_images/icon-google.png') }}" alt=""></a>
							<a href="#"><img src="{{ url('/site_images/icon-vk.png') }}" alt=""></a>
							<a href="#"><img src="{{ url('/site_images/icon-ok.png') }}" alt=""></a>
							<a href="#"><img src="{{ url('/site_images/icon-fb.jpg') }}" alt=""></a>
							<a href="#"><img src="{{ url('/site_images/icon-utube.png') }}" alt=""></a>
							<a href="#"><img src="{{ url('/site_images/icon-tw.jpg') }}" alt=""></a>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="create">
						Создание сайт <a href="http://ap-studio.com.ua/">AP-studio</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="{{ url('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
	<script src="{{ url('dist/js/main.js') }}"></script>
	@yield('js')
</body>
</html>