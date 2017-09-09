@extends('site.pageLayout')


@section('header')
	<title>{{$novelty->name}}</title>
@stop


@section('pageContent')

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="breadcrumbs mt10">
				<a href="/">
					<div class="breadcrumb-item">
						Главная
					</div>
				</a>
				<div class="breadcrumb-icon">
					<img src="{{ url('/site_images/breadcrumbs-item.png') }}" alt="">
				</div>
				<a href="/news-list">
					<div class="breadcrumb-item">
						Новости
					</div>
				</a>
				<div class="breadcrumb-icon">
					<img src="{{ url('/site_images/breadcrumbs-item.png') }}" alt="">
				</div>
				<div class="breadcrumb-item">
					{{$novelty->name}}
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="news-title mt20">
				<h1>{{$novelty->name}}</h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 mt10">
			<div class="novelty-image">
				<img src="{{ url('/news_images/' . $novelty->image ) }}">
			</div>
			<div class="novelty-text">
				{!! $novelty->text !!}
			</div>
		</div>
	</div>


	<div class="row">
		@foreach($comments as $comment)
		<div class="col-md-6 col-md-offset-3">
			<div class="comment-name">
				{{$comment->name}}:
			</div>
			<div class="comment-text">
				{{$comment->text}}
			</div>
		</div>
		@endforeach
	</div>
	

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
		<hr>
			<div class="add-comment-form">
				<form method="POST" action="../comment-add">
					{{csrf_field()}}
					<input name="item_id" type="hidden" value="{{$novelty->id}}"></input>
					<div class="add-comment-label">
						Имя:
					</div>
					<div class="add-comment-input">
						<input name="name"></input>
					</div>
					<div class="add-comment-label">
						Сообщение:
					</div>
					<div class="add-comment-input">
						<textarea name="text" ></textarea>
					</div>
					<div class="row">
						<div class="add-comment-button col-md-4 col-md-offset-8">
							<input type="submit"></input>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@stop