@extends('site.layout')


@section('js')
@stop

@section('header')
	<title>Система онлайн обучения</title>
@stop

@section('content')



@if(Session::get('bidSuccess'))
<div id="window" class="window-up">
	<div id="close-window">x</div>
	<div class="clear"></div>
	<div class="title-window">
		СПАСИБО
	</div>
	<div class="txt-window">
		Ваша заявка на бесплатный урок была успешно отправлена
	</div>
	<div class="more-info"><a href="#">Кнопка</a></div>
</div>
@endif

<div id="main-header">
	<div class="container">
		{{--<div class="row">--}}
			{{--<div class="col-lg-6 irina-Buzikova col-md-8 hidden-sm hidden-xs">--}}
				{{--<img src="{{ url('/site_images/irina-buzikova.png') }}">--}}
			{{--</div>--}}
			{{--<div class="col-lg-6 col-md-4 main-title">--}}
				{{--<img src="{{ url('/site_images/logo-white.png') }}">--}}
				{{--<h1>IT-ШКОЛА</h1>--}}
				{{--<h2>ИРИНЫ БУЗИКОВОЙ</h2>--}}
				{{--<div class="second-title"><span>Онлайн обучение </span>--}}
					{{--информационным технологиям--}}
				{{--</div>--}}

			{{--</div>--}}
		{{--</div>--}}
	</div>
</div>
<div class="container">
	<div class="advantages">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<img src="{{ url('/site_images/icon-calendar.png') }}">
				<div class="icon-text"><p>УДОБНОЕ</p><p>РАСПИСАНИЕ</p></div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<img src="{{ url('/site_images/icon-check.png') }}">
				<div class="icon-text"><p>ДОСТУПНО</p><p>КАЖДОМУ</p></div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<img src="{{ url('/site_images/icon-video.png') }}">
				<div class="icon-text"><p>ЛУЧШИЕ</p><p>ВИДЕОУРОКИ</p></div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<img src="{{ url('/site_images/icon-dialog.png') }}">
				<div class="icon-text"><p>ИНДИВИДУАЛЬНЫЕ</p><p>КОНСУЛЬТАЦИИ</p></div>
			</div>


		</div>
	</div>
</div>

{{--<div id="irina">--}}
	{{--<div class="container">--}}
		{{--<div class="row">--}}
			{{--<div class="col-sm-4"><img src="{{ url('/site_images/irina.png') }}"></div>--}}
			{{--<div class="col-sm-8">--}}
				{{--<img src="{{ url('/site_images/logo-blue.png') }}">--}}
				{{--<h2>ИРИНА БУЗИКОВА</h2>--}}
				{{--<h6>О создателе школы</h6>--}}
				{{--<div class="clear"></div>--}}
				{{--{!! $mainText !!}--}}
			{{--</div>--}}
		{{--</div>--}}
	{{--</div>--}}
{{--</div>--}}

<div class="container"><div class="row lead-title"><h2>ЛУЧШИЕ КУРСЫ</h2></div></div>
<div class="arrows">
	<svg version="1.1" id="arrow-slider-left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	viewBox="0 0 18 57" width="17px" xml:space="preserve">
	<polygon class="st0" points="18,0 18,57 0,28.5 "/>
</svg>
<svg version="1.1" id="arrow-slider-rigth" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
viewBox="0 0 18 57" width="17px" xml:space="preserve">
<polygon class="st0" points="0,0 0,57 18,28.5 "/>
</svg>

</div>
<div class="courses-slider">
	<div id="slider-inside">

		@foreach($courses as $course)

		<div class="course-item-slider">
			<a href="{{ url('/course/' . $course->url)}}">
				<div class="course-logo">
					<img src="{{ url('images/' . $course->logo) }}" alt="">
				</div>
			</a>


			<div class="line">
				<div class="course-stars">
					@include('site.components.stars', ['stars' => $course->stars])
				</div>
			</div>

			<a href="{{ url('/course/' . $course->url)}}">
				<div class="course-title">
					{{$course->name}}
				</div>
			</a>



			<div class="course-text">
				{!! $course->description !!}
			</div>


			<div class=" course-buttons">
				<a href="{{ url('/course/' . $course->url)}}">
					<div class="course-more">
						Подробнее
					</div>
				</a>
				<a href="/add-zayavka/{{$course->id}}">
					<div class="course-buy">
						Записаться на курс
					</div>
				</a>
			</div>
		</div>
		@endforeach

	</div>

</div>
<div class="slider-mobile">
	<div class="container">
		<div class="row">
			@foreach($courses as $course)
			<div class="col-md-6">
				<a href="{{ url('course/' . $course->url) }}">
					<div class="course-logo">
						<img src="{{ url('/images/' . $course->logo) }}" alt="">
					</div>
				</a>


				<div class="line">
					<div class="course-stars">
						@include('site.components.stars', ['stars' => $course->stars])
					</div>
				</div>


				<a href="{{ url('course/' . $course->url) }}">
					<div class="course-title">
						{{$course->name}}
					</div>
				</a>

				<div class="course-text">
					{!!$course->description!!}
				</div>

				<div class="course-buttons">
					<a href="{{ url('course/' . $course->url) }}">
						<div class="course-more">
							Подробнее
						</div>
					</a>
					<a href="{{ url('add-zayavka/' . $course->id) }}">
						<div class="course-buy">
							Записаться на курс
						</div>
					</a>
				</div>
			</div>
			@endforeach

		</div>
	</div>
</div>
<div class="container"><div class="row"><a href="courses"><div class="button-to-all">Все курсы</div></a></div></div>

<div class="programm">
	<div class="container">
		<div class="row lead-title"><h2>КАК ПРОХОДИТ ОБУЧЕНИЕ</h2></div>
		<div class="row">
			<div class="col-md-1 hidden-sm hidden-xs "></div>
			<div class="col-md-2 hidden-sm hidden-xs">
				<a href="/page/{{$progressPages[4]}}">
					<img src="{{ url('/site_images/icon-zayavka.png') }}">
				</a>
			</div>
			<div class="col-md-2 hidden-sm hidden-xs arr">
				<img src="{{ url('/site_images/arrows1.png') }}">
			</div>

			<div class="col-md-2 hidden-sm hidden-xs">
				<a href="/page/{{$progressPages[5]}}">
					<img src="{{ url('/site_images/icon-programm.png') }}">
				</a>
			</div>
			<div class="col-md-2 hidden-sm hidden-xs arr"><img src="{{ url('/site_images/arrows1.png') }}"></div>

			<div class="col-md-2 hidden-sm hidden-xs">
				<a href="/page/{{$progressPages[6]}}">
					<img src="{{ url('/site_images/icon-pay.png') }}">
				</a>
			</div>
			<div class="col-md-1 hidden-sm hidden-xs"></div>
		</div>
		<div class="row">
			<div class="col-md-4 hidden-sm hidden-xs progress-text">
				<a href="/page/{{$progressPages[4]}}">
					<div class="icon-text"><p>ПОДАЕТЕ ЗАЯВКУ</p><p>НА КУРС</p></div>
				</a>
			</div>
			<div class="col-md-4 hidden-sm hidden-xs progress-text">
				<a href="/page/{{$progressPages[5]}}">
					<div class="icon-text"><p>ВЫБИРАЕТЕ</p><p>ПРОГРАММУ ОБУЧЕНИЯ</p></div>
				</a>
			</div>
			<div class="col-md-4 hidden-sm hidden-xs progress-text">
				<a href="/page/{{$progressPages[6]}}">
					<div class="icon-text"><p>ОЖИДАЕТЕ</p><p>АКТИВАЦИИ</p></div>
				</a>
			</div>
		</div>
		<div class="row"><div class="col-md-9 hidden-sm hidden-xs"></div><div class="col-md-2 hidden-sm hidden-xs arr1"><img src="{{ url('/site_images/arrows3.png') }}"></div><div class="col-md-1 hidden-sm hidden-xs"></div></div>
		<div class="row">
			<div class="col-md-1 hidden-sm hidden-xs"></div>
			<div class="col-md-2 hidden-sm hidden-xs">
				<a href="/page/{{$progressPages[7]}}">
					<img src="{{ url('/site_images/icon-diplom.png') }}">
				</a>
			</div>
			<div class="col-md-2 hidden-sm hidden-xs arr"><img src="{{ url('/site_images/arrows5.png') }}"></div>

			<div class="col-md-2 hidden-sm hidden-xs">
				<a href="/page/{{$progressPages[8]}}">
					<img src="{{ url('/site_images/icon-finish.png') }}">
				</a>
			</div>
			<div class="col-md-2 hidden-sm hidden-xs arr"><img src="{{ url('/site_images/arrows4.png') }}"></div>

			<div class="col-md-2 hidden-sm hidden-xs">
				<a href="/page/{{$progressPages[9]}}">
					<img src="{{ url('/site_images/icon-study.png') }}">
				</a>
			</div>
			<div class="col-md-1 hidden-sm hidden-xs"></div>
		</div>
		<div class="row">
			<div class="col-md-4 hidden-sm hidden-xs progress-text">
				<a href="/page/{{$progressPages[7]}}">
					<div class="icon-text"><p>ПОЛУЧАЕТЕ </p><p>СЕРТИФИКАТ</p></div>
				</a>
			</div>
			<div class="col-md-4 hidden-sm hidden-xs progress-text">
				<a href="/page/{{$progressPages[8]}}">
					<div class="icon-text"><p>ВЫПОЛНЯЕТЕ</p><p>ИТОГОВУЮ РАБОТУ</p></div>
				</a>
			</div>
			<div class="col-md-4 hidden-sm hidden-xs progress-text">
				<a href="/page/{{$progressPages[9]}}">
					<div class="icon-text"><p>ОБУЧАЕТЕСЬ ПО</p><p>ВЫБРАННОЙ ПРОГРАММЕ</p></div>
				</a>
			</div>
		</div>


		<div class="row">
			<div class="col-sm-4 hidden-lg hidden-md progress-text">
				<a href="/page/{{$progressPages[4]}}">
					<img src="{{ url('/site_images/icon-zayavka.png') }}"><div class="icon-text"><p>ПОДАЕТЕ ЗАЯВКУ</p><p>НА КУРС</p></div>
				</a>
			</div>
			<div class="col-sm-4  hidden-lg hidden-md progress-text">
				<a href="/page/{{$progressPages[5]}}">
					<img src="{{ url('/site_images/icon-programm.png') }}"><div class="icon-text"><p>ВЫБИРАЕТЕ</p><p>ПРОГРАММУ ОБУЧЕНИЯ</p></div>
				</a>
			</div>

			<div class="col-sm-4  hidden-lg hidden-md progress-text">
				<a href="/page/{{$progressPages[6]}}">
					<img src="{{ url('/site_images/icon-pay.png') }}"><div class="icon-text"><p>ОПЛАЧИВАЕТЕ</p><p>КУРС</p></div>
				</a>
			</div>

			<div class="col-sm-4  hidden-lg hidden-md progress-text">
				<a href="/page/{{$progressPages[7]}}">
					<img src="{{ url('/site_images/icon-study.png') }}"><div class="icon-text"><p>ОБУЧАЕТЕСЬ ПО</p><p>ВЫБРАННОЙ ПРОГРАММЕ</p></div>
				</a>
			</div>

			<div class="col-sm-4  hidden-lg hidden-md progress-text">
				<a href="/page/{{$progressPages[8]}}">
					<img src="{{ url('/site_images/icon-finish.png') }}"><div class="icon-text"><p>ВЫПОЛНЯЕТЕ</p><p>ИТОГОВУЮ РАБОТУ</p></div>
				</a>
			</div>


			<div class="col-sm-4  hidden-lg hidden-md progress-text">
				<a href="/page/{{$progressPages[9]}}">
					<img src="{{ url('/site_images/icon-diplom.png') }}"><div class="icon-text"><p>ПОЛУЧАЕТЕ </p><p>СЕРТИФИКАТ</p></div>
				</a>
			</div>


		</div>


	</div>
</div>

<div class="students">
	<div class="arrows">
		<svg version="1.1" id="arrow-student-left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		viewBox="0 0 18 57" width="17px" xml:space="preserve">
		<polygon class="st0" points="18,0 18,57 0,28.5 "/>
	</svg>
	<svg version="1.1" id="arrow-student-rigth" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	viewBox="0 0 18 57" width="17px" xml:space="preserve">
	<polygon class="st0" points="0,0 0,57 18,28.5 "/>
</svg>

</div>
<div class="container">
	<div class="row lead-title"><h2>УЧЕНИКИ</h2></div>
	<div class="row">
		<div class="student-slider-out">
			<div id="student-slider-inside">
				@foreach($sliderUsers as $sliderUser)
				<div class="one-student">
					<div style="background-image: url(/user_logos/{{$sliderUser->logo}});" class="image-student"></div>
					<div class="student-name">
						<p>{{$sliderUser->name}}</p>
						<p>{{$sliderUser->surname}}</p>
					</div>
					<span>г. {{$sliderUser->city}}</span>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
</div>
<div class="students-mob">
	<div class="container">
		<div class="row">
			@foreach($sliderUsers as $sliderUser)
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="one-student">
					<div style="background-image: url(/user_logos/{{$sliderUser->logo}});" class="image-student"></div>
					<div class="student-name">
						<p>{{$sliderUser->name}}</p>
						<p>{{$sliderUser->surname}}</p>
					</div>
					<span>г. {{$sliderUser->city}}</span>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>

<div class="present">
	<div class="container">
		<div class="row">
			<img src="{{ url('/site_images/icon-bookmark.png') }}"><h5>ПРОБНЫЙ УРОК!</h5><img src="{{ url('/site_images/icon-present.png') }}">

		</div>
		<div class="row">
			<div class="col-md-1 hidden-sm"></div>
			<div class="col-md-5 col-sm-7">
				<!-- <h6>Получите бесплатный урок <br>
					<span style="color: #e28500">«Как переустановить Windows 7/8/10»</span></h6><br>
					<p>Введите свои данные в форму подписки, <br>
						и получите очень интересный урок <br>
						<span style="font-size:22px;">от Ирины Бузиковой, </span><br>
						с помощью которого Вы легко сможете <br>
						переустановить операционную систему. </p> -->
						{!! $lessonText !!}


					</div>
					<div class="col-md-1 hidden-sm"><img src="{{ url('/site_images/arrow-present.png') }}"></div>
					<div class="col-md-4 col-sm-5">
						<form method="POST" action="bid-add">
							{{csrf_field()}}
							<input type="text" class="bid-input" name="name" placeholder="Имя">
							<input type="text" class="bid-input" name="email" placeholder="Email">
							<button type="submit">Получить урок</button>
						</form>
					</div>
					<div class="col-md-1 hidden-sm"></div>
				</div>

			</div>
		</div>
		{{--<div class="iphone">--}}
			{{--<div class="container">--}}
				{{--<div class="row">--}}
					{{--<div class="col-md-2 hidden-sm"></div>--}}
					{{--<div class="col-md-6 col-sm-12 ">--}}
						{{--{!! $giftText !!}--}}
					{{--</div>--}}

					{{--<div class="col-sm-2 col-md-2 col-sm-12">--}}
						{{--<img src="{{ url('/site_images/icon-iphone.png') }}">--}}
					{{--</div>--}}
					{{--<div class="col-md-2 hidden-sm">--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="row">--}}
					{{--<div class="col-md-2 hidden-sm"></div>--}}
					{{--<div class="col-md-8 col-sm-12">--}}
						{{--{!! $giftText2 !!}--}}
						{{--<div class="button-iphone"><a href="{{ url('zayavka') }}">Подать заявку на курс</a></div>--}}
					{{--</div>--}}
					{{--<div class="col-md-2 hidden-sm"></div>--}}
				{{--</div>--}}
			{{--</div>--}}
		{{--</div>--}}


		@include('site.components.newsBlock', ['news' => $news])

		@stop