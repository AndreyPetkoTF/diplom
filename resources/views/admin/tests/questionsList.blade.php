@extends('admin.layout')


@section('content')

<section class="content-header">
	<h1>
		Вопросы теста {{$test->name}}
	</h1>

</section>

<section class="content-header">
	<div class="row">
		<div class="col-md-3">
			<a href="/admin/tests/question-add/{{$test->id}}"><button type="button" class="btn btn-block btn-primary btn-flat add-product-button">Добавить вопрос</button></a>
		</div>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Список курсов</h3>
				</div>
				<div class="box-body">
					<table  class="table table-bordered table-hover">
						<tr>
							<th>Название</th>
							<th>Редактировать</th>
							<th>Урок</th>
						</tr>
						@foreach($questions as $question)
						<tr>
							<td>{!!$question->text!!}</td>
							<th><a href="/admin/tests/question-edit/{{$question->id}}">Редактировать</a></th>
							<td>
								<form action="/admin/tests/question-delete" method="POST" onsubmit="return confirm('Вы точно хотите удалить вопрос?')">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="question_id" value="{{$question->id}}">
									<button type="submit" class="btn btn-block btn-danger btn-flat">Удалить</button>
								</form>
							</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</section>


@stop