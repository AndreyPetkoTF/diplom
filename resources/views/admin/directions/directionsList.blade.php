@extends('admin.layout')


@section('content')

<section class="content-header">
	<h1>
		Направления курсов
	</h1>

</section>

<section class="content-header">
	<div class="row">
	<div class="col-md-3">
			<a href="/admin/course"><button type="button" class="btn btn-block btn-primary btn-flat add-product-button">Список курсов</button></a>
		</div>
		<div class="col-md-3">
			<a href="/admin/course/direction-add"><button type="button" class="btn btn-block btn-primary btn-flat add-product-button">Добавить направление</button></a>
		</div>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Список направлений</h3>
				</div>
				<div class="box-body">
					<table  class="table table-bordered table-hover">
						<tr>
							<th>Название</th>
							<th>Удалить</th>
						</tr>
						@foreach($directions as $direction)
						<tr>
							<td><a href="/admin/course/direction-edit/{{$direction->id}}">{{$direction->name}}</a></td>
							<td>
								<form action="/admin/course/direction-delete" method="POST" onsubmit="return confirm('Вы точно хотите удалить товар: {{$direction->name}} ?')">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="id" value="{{$direction->id}}">
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