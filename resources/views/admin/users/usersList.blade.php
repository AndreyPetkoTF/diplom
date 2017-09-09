@extends('admin.layout')


@section('content')


<section class="content-header">
	<h1>
		Пользователи
	</h1>

</section>

<section class="content-header">
	<div class="row">
		<div class="col-md-3">
			<a href="/admin/news/add"><button type="button" class="btn btn-block btn-primary btn-flat add-product-button">Добавить пользователя</button></a>
		</div>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Список пользователей</h3>
				</div>
				<div class="box-body">
					<table  class="table table-bordered table-hover">
						<tr>
							<th>Имя</th>
							<th>Удалить</th>
						</tr>
						@foreach($users as $user)
						<tr>
							<td><a href="/admin/users/single/{{$user->id}}">{{$user->name}}</a></td>
							<td class="small-delete">
								<form action="/admin/users/delete" method="POST" onsubmit="return confirm('Вы точно хотите удалить пользователя: {{$user->name}} ?')">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="user_id" value="{{$user->id}}">
									<button type="submit" class="btn btn-block btn-danger btn-flat">Блокировать и удалить курсы</button>
								</form>
							</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<?php echo $users->render() ?>
		</div>
	</div>
</section>


@stop