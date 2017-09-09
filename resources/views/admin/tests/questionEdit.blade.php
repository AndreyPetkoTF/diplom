	@extends('admin.layout')

	@section('js')
	<script src="{{ url('/dist/js/questionAdd.js') }}"></script>
	<script src="{{ url('/dist/js/questionEdit.js') }}"></script>
	@stop


	@section('content')

	<section class="content-header">
		<h1>
			Обновить вопрос
		</h1>
	</section>

	<div id="answer-item">
		<div class="form-group">
			<label for="name">Вариант ответа:</label>
			<input type="text" class="form-control" name="answer[]"/>
		</div>

		<div class="form-group">
			<label for="name">Правильный:</label>
			<input type="checkbox" name="true" class="right-checkbox">
			<div class="delete-answer">
				<a href="">Удалить</a>
			</div>
		</div>
	</div>

	<section class="content">
		<div class="row">

			<div class="col-md-12">

				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">Форма добавления теста</h3>
					</div>

					<!-- /.box-header -->
					<div class="box-body">
						@if(count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach($errors->all() as $error)
								<li>{{$error}}</li>
								@endforeach
							</ul>
						</div>
						@endif
						<form method="POST" action="" enctype="multipart/form-data">
							{{csrf_field()}}
							<input type="hidden" name="right" id="right" value="0">
							<input type="hidden" name="rightId" id="rightId" value="{{$rightId}}">

							<div class="form-group">
								<label for="name">Текст вопроса</label>
								<textarea class="form-control" name="text">{!!$question->text!!}</textarea>
							</div>


							<div class="form-group">
								<label>Позиция:</label>
								<input type="text" class="form-control" value="{{$question->position}}" name="position"/>
							</div>




							@foreach($answers as $answer)
							<div class="form-group">
								<label for="name">Вариант ответа:</label>
								<input type="text" class="form-control" value="{{$answer->text}}" name="old_answer[{{$answer->id}}]" />
							</div>

							<div class="form-group">
								<label for="name">Правильный:</label>
								<input type="checkbox" data-id="{{$answer->id}}" @if($answer->right) checked @endif name="true" class="old-right-checkbox">
								<div class="delete-answer">
									<a href="">Удалить</a>
								</div>
							</div>
							@endforeach

							<div id="newItems"></div>


							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<button id="add-answer" class="btn btn-block btn-primary btn-flat">Добавить вариант ответа</button>
									</div>
								</div>
							</div>


							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<button type="submit" class="btn btn-block btn-primary btn-flat">Обновить</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</section>

	@stop