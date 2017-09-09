@extends('admin.layout')


@section('content')

<section class="content-header">
	<h1>
		Уроки курса "{{$course->name}}"
	</h1>

</section>

<section class="content-header">
	<div class="row">
		<div class="col-md-3">
			<a href="/admin/lessons/add/{{$course->id}}"><button type="button" class="btn btn-block btn-primary btn-flat add-product-button">Добавить урок</button></a>
		</div>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Список уроков</h3>
				</div>
				<div class="box-body">
					<table  class="table table-bordered table-hover">
						<tr>
							<th>Название</th>
							<th>Удалить</th>
						</tr>
						@foreach($course->lessons as $lesson)
						<tr>
							<td><a href="/admin/lessons/edit/{{$lesson->id}}">{{$lesson->name}}</a></td>
							<td>
								<form action="/admin/lessons/delete" method="POST" onsubmit="return confirm('Вы точно хотите удалить товар: {{$lesson->name}} ?')">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="lesson_id" value="{{$lesson->id}}">
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