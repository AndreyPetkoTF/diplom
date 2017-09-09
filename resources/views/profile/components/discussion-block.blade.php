		<div class="title">
			Обсуждения
		</div>
		<div class="ask-question">
			<a href="{{ url('/profile/discussions') }}">
				<div class="ask-image">
					<img src="{{ url('/profile_images/question.png') }}" alt="">
				</div>
				<div class="ask-text">
					Задать вопрос
				</div>
			</a>
		</div>

		@foreach($discussions as $discussion)

		<a href="{{ url('profile/discussions/single/' . $discussion->id) }}">
			<div class="discussion">
				<div class="discussion-title">
					{{$discussion->title}}
				</div>
				<div class="discussion-bottom">
					<div class="discussion-date">
						{{$discussion->created_at->format('d.m.Y')}}
					</div>
					<div class="disscution-answers">
						Ответов({{$discussion->answers}})
					</div>
				</div>
			</div>
		</a>

		@endforeach