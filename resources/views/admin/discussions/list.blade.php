@extends('admin.layout')


@section('content')

<section class="content-header">
	<h1>
		Дискусии
	</h1>

</section>


<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Список дискусий</h3>
				</div>
				<div class="box-body">
					<table class="table table-bordered table-hover">
						<tbody>
							<tr>
								<th>Название</th>
								<th>Курс</th>
								<th>Урок</th>
								<th>Сообшения</th>
								<th>Перейти</th>
								<th>Удалить</th>
							</tr>
							@foreach($discussions as $discussion)
							<tr>
								<td><a href="/admin/discussion/single/{{$discussion->id}}">{{$discussion->title}}</a></td>
								<td>
									@if($discussion->courseName)
									{{$discussion->courseName}}
									@else
									-
									@endif
								</td>
								<td>
									@if($discussion->lessonName)
									{{$discussion->lessonName}}
									@else
									-
									@endif
								</td>
								<td>{{$discussion->countMessages}}</td>
								<td><a target="_blank" href="/profile/discussions/single/{{$discussion->id}}">Перейти</a></td>
								<td>
									<form action="/admin/discussion/delete/{{$discussion->id}}" method="POST" onsubmit="return confirm('Вы точно хотите удалить дискусию?')">
										<input type="hidden" name="_token" value="{{csrf_token()}}">
										<input type="hidden" name="discussion_id" value="6">
										<button type="submit" class="btn btn-block btn-danger btn-flat">Удалить</button>
									</form>
								</td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<?php echo $discussions->render(); ?>
		</div>
	</div>
</section>


@stop