@extends('admin.layout')


@section('content')

<section class="content-header">
	<h1>
		Присланные домашние задания
	</h1>

</section>


<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Список ответов</h3>
				</div>
				<div class="box-body">
					<table  class="table table-bordered table-hover">
						<tr>
							<th>Название урока</th>
							<th>Название курса</th>
							<th>Имя пользователя</th>
							<th>Сообшения</th>
							<th>Список файлов</th>
						</tr>
						@foreach($userLessons as $userLesson)
						<tr>
							<td>{{$userLesson->lessonName}}</td>
							<td>{{$userLesson->courseName}}</td>
							<td>{{$userLesson->userName}}</td>
							<td>
								@if($userLesson->mail)
									<img src="{{ url('/profile_images/mail.png') }}" alt="">
								@endif
							</td>
							<td>
								<a href="/admin/homework/files/{{$userLesson->id}}">
									Подробнее
								</a>
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