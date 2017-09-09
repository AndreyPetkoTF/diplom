	@extends('admin.layout')

	@section('js')
	<script src="{{ url('/dist/js/questionAdd.js') }}"></script>

	@stop


	@section('content')

	<section class="content-header">
		<h1>
			Добавить вопрос
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

							<input type="hidden" name="test_id" value="{{$test_id}}">
							<div class="form-group">
								<label for="name">Текст вопроса</label>
								<textarea class="form-control" name="text">
								</textarea>
							</div>


						<div class="form-group">
							<label>Позиция:</label>
							<input type="text" class="form-control" name="position"/>
						</div>



							<div class="form-group">
								<label for="name">Вариант ответа:</label>
								<input type="text" class="form-control" name="answer[]" />
							</div>

							<div class="form-group">
								<label for="name">Правильный:</label>
								<input type="checkbox" name="true" class="right-checkbox">
							</div>

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
										<button type="submit" class="btn btn-block btn-primary btn-flat">Добавить</button>
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