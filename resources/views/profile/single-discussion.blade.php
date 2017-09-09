@extends('profile.layout')

@section('js')
<script src="{{ url('dist/js/smiles.js')}} "></script>
@stop


@section('content')


<div class="breadcrumbs">
	<div class="breadcrumb-home">
		<img src="{{ url('/profile_images/home-icon.png') }}" alt="">
	</div>
	<div class="breadcrumb-border"></div>
	<div class="breadcrumb-item">
		Обсуждения
	</div>
	<div class="breadcrumb-border"></div>
	<div class="breadcrumb-item">
		{{$discussion->title}}
	</div>
</div>

<div class="content">
	<div class="col-lg-9 col-md-8">
		<div class="title">
			{!!$discussion->title!!}
		</div>

		<div class="row">
			<div class="col-xs-2">
				<div class="user-logo">
					@if(!$firstMessage->logo)
					<img src="{{ url('/profile_images/%D1%81%D0%BE%D0%B2%D0%B0-copy.png') }}" alt="">
					@else
					<img src="{{ url('/user_logos/' . $firstMessage->logo) }}">
					@endif
				</div>
				<div class="user-name">
					{{$firstMessage->name}}
				</div>
			</div>
			<div class="col-xs-8">
				<div class="one-disc-text">
					{!!$firstMessage->text!!}
				</div>
			</div>
			<div class="col-xs-2">
				<div class="question-img">
					<img src="{{ url('/profile_images/no-logo.png') }}" alt="">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3 col-md-offset-7 col-xs-6">
				<div class="one-disc-infotext">
					Дата публикации: <span>{{$firstMessage->created_at->format('d.m.Y')}}</span>
				</div>
			</div>
			<div class="col-md-2 col-xs-6">
				<div class="one-disc-infotext">
					Ответов: <span>{{ $messages->total() }}</span>
				</div>
			</div>
		</div>

		<div class="one-disc-line"></div>

		<div class="answers-list">
			@foreach($messages as $message)
			<div class="one-answer">
				<div class="row">
					<div class="col-md-offset-1 col-xs-2">
						<div class="user-logo">
							@if(!$message->logo)
							<img src="{{ url('/profile_images/112965409_suychik.png') }}" alt="">
							@else
							<img src="{{ url('user_logos/' . $message->logo) }}">
							@endif
						</div>
						<div class="user-name">
							{{$message->name}}
						</div>

					</div>
					<div class="col-sm-7 col-xs-9">
						<div class="one-disc-text">
							{!!$message->text!!}
						</div>
						<div class="one-disc-date visible-xs">
							{{ $message->created_at->format('d.m.y') }}
						</div>
					</div>
					<div class="col-sm-2 hidden-xs">
						<div class="one-disc-date">
							{{ $message->created_at->format('d.m.y') }}
						</div>
					</div>
				</div>
			</div>
			@endforeach

		</div>

		@include('pagination.default', ['paginator' => $messages])

		<form method="post" action="{{ url('/profile/discussions/message-add') }}">
			{{csrf_field()}}
			<input type="hidden" value="{{$discussion->id}}" name="discussion_id"></input>
			<div class="row">
				<div class="new-answer-row">
					<div class="col-md-8 col-md-offset-1 answer-area">
						<textarea name="text" placeholder="Введите сообщение" id="discussionText"></textarea>
					</div>
					<div class="col-md-2 form-submit">
						<button type="submit">Отправить</button>
					</div>
				</div>
			</div>
			<div class="row smiles">
				<div class="row">
				<div class="col-md-8 col-md-offset-1">
						<div class="row">
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s1.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s2.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s3.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s4.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s5.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s6.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s7.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s8.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s9.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s10.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s11.png') }}"></div>
							<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s12.png') }}"></div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="col-lg-3 col-md-4">
		<div class="row">
			<div class="col-lg-12 visible-lg">
				<div class="owl">
					<img src="{{ url('/profile_images/sov/sova-2.png') }}" alt="">
				</div>
			</div>
		</div>

		@include('profile.components.discussion-block', [ 'discussions' => $discussions ])

	</div>
</div>
</div>

@stop