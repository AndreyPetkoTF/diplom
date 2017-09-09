
@extends('site.pageLayout')

@section('header')
<title>Новости</title>
@stop


@section('pageContent')


<div class="courses-title">
	<h1>НОВОСТИ</h1>
</div>


<div class="container">
	<div class="row">
		<div class="col-md-9">
			@foreach($news as $newItem)
			<div class="news-item mt20">
				<div class="row">
					<div class="col-md-12">
						<a href="/novelty/{{$newItem->url}}">
							<div class="news-title-list">
								{{$newItem->name}}
							</div>
						</a>
					</div>
				</div>
				<div class="row mt10">
					<div class="col-md-4 max-img">
						<a href="/novelty/{{$newItem->url}}"> <img src="{{ url('/news_images/' . $newItem->image) }}" alt=""></a>
					</div>
					<div class="col-md-8">
						<div class="news-text">
							{!!$newItem->description!!}
						</div>

						<div class="hr"></div>
						<div class="row">
							<div class="col-md-8">
								<div class="news-date mt10">
									{{$newItem->created_at}}
								</div>
								<div class="news-comments">
									Комментарии({{$newItem->comments}})
								</div>
							</div>
							<div class="col-md-4 more-block mt10">
								<a href="/novelty/{{$newItem->url}}">
									<div class="news-more">
										Узнать больше
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			<div class="row">
				<div class="paginator">
					<?php echo $news->render(); ?>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="row">
				<div class="col-md-4">
					<div class="stay-logo max-img mt20">
						<img src="{{ url('/site_images/staylogo.png') }}" alt="">
					</div>
				</div>
				<div class="col-md-8">
					<div class="stay-text mt20">
						БУДЬ В КУРСЕ!
					</div>
				</div>
			</div>


			<form method="POST" action="sendmail-add">
				{{csrf_field()}}
				<div class="row">
					<div class="col-md-12">
						<div class="sub-input mt20">
							<input type="text" name="email" placeholder="Email">
						</div>
					</div>
				</div>

				<div class="bit-form-submit sub-submit mt5">
					<input type="submit" value="Подписаться на рассылку">
				</div>
			</form>

			<div class="courses-title">
				<h2>РЕКОМЕНДУЕМ</h2>
			</div>
			<div class="row">
				@foreach($courses as $course)
				<div class="col-md-12">
					<div class="course-item-side">
						<a href="/course/{{$course->url}}">
							<div class="course-logo course-logo-side">
								<img src="{{ url('/images/' . $course->logo) }}" alt="">
							</div>
						</a>
						<div class="row">
							<div class="course-stars">
								<img src="{{ url('/site_images/star.png') }}" alt="">
								<img src="{{ url('/site_images/star.png') }}" alt="">
								<img src="{{ url('/site_images/star.png') }}" alt="">
								<img src="{{ url('/site_images/star.png') }}" alt="">
								<img src="{{ url('/site_images/star.png') }}" alt="">
							</div>
						</div>

						<div class="row">
							<a href="/course/{{$course->url}}">
								<div class="course-title">
									{{$course->name}}
								</div>
							</a>
						</div>

						<div class="row course-buttons">
							<a href="/course/{{$course->url}}">
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
				</div>
				@endforeach

			</div>
		</div>
	</div>
</div>



@stop