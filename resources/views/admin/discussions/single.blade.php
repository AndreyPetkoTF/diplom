@extends('admin.layout')


@section('content')

<section class="content-header">
	<h1>
		Страница одной дискусии
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
								<th>Сообшения</th>
								<th>Имя пользователя</th>
								<th>Редактировать</th>
								<th>Удалить</th>
							</tr>
							@foreach($messages as $message)
							<tr>
								<td>{!!$message->text!!}</td>
								<td>{{$message->name}}</td>
								<td><a href="/admin/discussion/message-update/{{$message->id}}">Редактировать</a></td>
								<td>
									<form action="/admin/discussion/delete-message/{{$message->id}}" method="POST" onsubmit="return confirm('Вы точно хотите удалить сообшение дискусии?')">
										<input type="hidden" name="_token" value="{{csrf_token()}}">
										<input type="hidden" name="discussion_message_id" value="6">
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
			<?php echo $messages->render(); ?>
		</div>
	</div>
</section>


@stop