@extends('admin.layout')


@section('content')

<section class="content-header">
	<h1>
		Тесты
	</h1>

</section>

<section class="content-header">
	<div class="row">
		<div class="col-md-3">
			<a href="/admin/tests/add"><button type="button" class="btn btn-block btn-primary btn-flat add-product-button">Добавить тест</button></a>
		</div>

		<div class="col-md-3">
			<a href="/admin/tests/users"><button type="button" class="btn btn-block btn-primary btn-flat add-product-button">Тесты пользователей</button></a>
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
							<th>Урок</th>
							<th>Вопросы</th>
							<th>Удалить</th>
						</tr>
						@foreach($tests as $test)
						<tr>
							<td><a href="/admin/tests/edit/{{$test->id}}">{{$test->name}}</a></td>
							<td>{{$test->lessonName}}</td>
							<td><a href="/admin/tests/questions/{{$test->id}}">Вопросы</a></td>
							<td>
								<form action="/admin/tests/delete" method="POST" onsubmit="return confirm('Вы точно хотите удалить товар: {{$test->name}} ?')">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="test_id" value="{{$test->id}}">
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