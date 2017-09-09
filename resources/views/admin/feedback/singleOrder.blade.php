@extends('admin.layout')


@section('content')

<section class="content-header">
	<h1>
		Информация о пользователе
	</h1>
</section>



@if($order->paid == 0)
<section class="content-header">
	<div class="row">
		<div class="col-md-3">
			<a href="/admin/feedback/set-order-paid/{{$order->id}}"><button type="button" class="btn btn-block btn-success btn-flat">Активировать</button></a>
		</div>
	</div>
</section>

@endif

<section class="my-content">
	<div class="box-body table-responsive no-padding info-table">
		<table class="table table-bordered">
			<tbody>

				<tr>
					<th>Поле</th>
					<th>Значение</th>
				</tr>


				@if($order->user)
				<tr>
					<td>Пользователь</td>
					<td>
						<a href="/admin/users/single/{{$order->user->id}}">
							Страница пользователя
						</a>
					</td>
				</tr>
				@endif

				<tr>
					<td>Имя</td>
					<td>{{$order->name}}</td>
				</tr>

				<tr>
					<td>Фамилия</td>
					<td>{{$order->surname}}</td>
				</tr>

				<tr>
					<td>Отчество</td>
					<td>{{$order->patronymic}}</td>
				</tr>


				<tr>
					<td>Email</td>
					<td>{{$order->email}}</td>
				</tr>

				<tr>
					<td>Skype</td>
					<td>{{$order->skype}}</td>
				</tr>

				<tr>
					<td>Дата рождения</td>
					<td>{{$order->birthday}}</td>
				</tr>


				<tr>
					<td>Город</td>
					<td>{{$order->city}}</td>
				</tr>




			</tbody>
		</table>
	</div>
</section>

<section class="content-header">
	<h1>
		Заказанные курсы
	</h1>
</section>


<section class="my-content">
	<div class="box-body table-responsive no-padding info-table">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th>Курс</th>
				</tr>

				@foreach($orderCourses as $course)
				<tr>
					<td>{{$course->name}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</section>

@stop